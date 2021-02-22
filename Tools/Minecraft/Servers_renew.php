<?php
chdir("../../");
set_include_path("../../");

$dev = true;

require "Core/MinecraftServer.class.php";
require "Core/Init.php";
require "vendor/autoload.php";

$ssh = new phpseclib\Net\SSH2($config["minecraft"]["free_server"]);
$key = new phpseclib\Crypt\RSA();
$key->setPassword(file_get_contents("Auth/Password"));
$key->loadKey(file_get_contents("Auth/Private.ppk"));
if (!$ssh->login("user", $key)) {
	trigger_error("Erreur auth SSH");
	return false;
}

$query = $db->prepare("SELECT * FROM minecraft_sessions WHERE ".time()." > final_expiration");
$query->execute();
$data = $query->fetchAll();

foreach ($data as $value) {
	$value = array_map("trim", $value);
	
	echo "-> {$value["server_port"]}\n";
	
	$server = new MinecraftServer($value["server_port"]);
	$server->rcon->sendCommand("stop");
	sleep(3);
	
	$ssh->exec("rm -R /opt/minecraft/s{$value["server_port"]}/");
	$ssh->exec("cp -R /opt/minecraft/default/ /opt/minecraft/s{$value["server_port"]}");

	$config = "spawn-protection=16
max-tick-time=60000
query.port=QUERY_PORT
generator-settings=
sync-chunk-writes=true
force-gamemode=false
allow-nether=true
enforce-whitelist=false
gamemode=survival
broadcast-console-to-ops=true
enable-query=false
player-idle-timeout=0
text-filtering-config=
difficulty=easy
spawn-monsters=true
broadcast-rcon-to-ops=true
op-permission-level=4
pvp=true
entity-broadcast-range-percentage=100
snooper-enabled=true
level-type=default
hardcore=false
enable-status=true
enable-command-block=false
max-players=20
network-compression-threshold=256
resource-pack-sha1=
max-world-size=29999984
function-permission-level=2
rcon.port=RCON_PORT
server-port=SERVER_PORT
server-ip=
spawn-npcs=true
allow-flight=false
level-name=world
view-distance=10
resource-pack=
spawn-animals=true
white-list=false
rcon.password=RCON_PASSWORD
generate-structures=true
online-mode=true
max-build-height=256
level-seed=
prevent-proxy-connections=false
use-native-transport=true
enable-jmx-monitoring=false
motd=A Minecraft Server
rate-limit=0
enable-rcon=true
";

	$query = $db->prepare("SELECT rcon_port, rcon_password FROM minecraft_servers WHERE server_port = :server_port");
	$query->bindValue(":server_port", $value["server_port"], PDO::PARAM_INT);
	$query->execute();
	$data2 = array_map("trim", $query->fetch());

	$config = str_replace("SERVER_PORT", $value["server_port"], $config);
	$config = str_replace("RCON_PORT", $data2["rcon_port"], $config);
	$config = str_replace("QUERY_PORT", $value["server_port"], $config);
	$config = str_replace("RCON_PASSWORD", $data2["rcon_password"], $config);
	
	$config = explode("\n", $config);
	
	$ssh->exec("rm /opt/minecraft/s{$value["server_port"]}/server.properties");
	
	foreach ($config as $line) {
		$ssh->exec("echo $line >> /opt/minecraft/s{$value["server_port"]}/server.properties");
	}
	
	$ssh->exec("cd /opt/minecraft/s{$value["server_port"]}/ && screen -dmS minecraft_{$value["server_port"]} java -Xms512M -Xmx4096M -jar /opt/minecraft/s{$value["server_port"]}/server.jar");

	$query = $db->prepare("DELETE FROM minecraft_sessions WHERE session = :session");
	$query->bindValue(":session", $value["session"], PDO::PARAM_STR);
	$query->execute();
	
	$query = $db->prepare("UPDATE minecraft_servers SET owner = '' WHERE owner = :owner");
	$query->bindValue(":owner", $value["session"], PDO::PARAM_STR);
	$query->execute();
}