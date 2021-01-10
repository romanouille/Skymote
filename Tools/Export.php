<?php
ini_set("memory_limit", "16G");
$dev = false;

set_include_path("../");
chdir("../");

if (!file_exists("Core/table")) {
	file_put_contents("Core/table", 1);
}

$tempDir = sys_get_temp_dir();

require "Core/Apokaliz.class.php";
require "Core/Init.php";

echo "dump_as\n";
$result = "id,name,country\n";

$query = $db->prepare("SELECT id, name, country FROM dump_as_$table ORDER BY id ASC");
$query->execute();
$data = $query->fetchAll();

foreach ($data as $value) {
	$value = array_map("trim", $value);
	
	$result .= "{$value["id"]},".str_replace(",", "", $value["name"]).",{$value["country"]}\n";
}

file_put_contents("AS.csv", $result);


echo "dump_blocks\n";
$result = "version,block,block_start,block_end,country,lir,created,rir\n";

$query = $db->prepare("SELECT version, block, block_start, block_end, country, lir, created, rir FROM dump_blocks_$table ORDER BY id ASC");
$query->execute();
$data = $query->fetchAll();

foreach ($data as $value) {
	$value = array_map("trim", $value);
	
	$result .= "{$value["version"]},{$value["block"]},{$value["block_start"]},{$value["block_end"]},{$value["country"]},{$value["lir"]},{$value["created"]},".$rirList[$value["rir"]]."\n";
}

file_put_contents("Blocks.csv", $result);


echo "dump_lir\n";
$result = "id,rir,created\n";

$query = $db->prepare("SELECT id, rir, created FROM dump_lir_$table ORDER BY id ASC");
$query->execute();
$data = $query->fetchAll();

foreach ($data as $value) {
	$value = array_map("trim", $value);
	
	$result .= "{$value["id"]},".$rirList[$value["rir"]].",{$value["created"]}\n";
}

file_put_contents("Lir.csv", $result);


echo "dump_ripe_allocations\n";
$query = $db->prepare("SELECT version, block, block_start, block_end, org, country, netname, description, remarks, status, created, modified FROM dump_ripe_allocations_$table");
$query->execute();
$data = $query->fetchAll();
$result = "";

file_put_contents("Ripe_allocations.csv", "version,block,block_start,block_end,org,country,netname,description,remarks,status,created,modified\n");

foreach ($data as $value) {
	$value = array_map(function($a) { return str_replace("\n", " ", str_replace("\r", " ", str_replace(",", "", trim($a)))); }, $value);
	
	$result .= "{$value["version"]},{$value["block"]},{$value["block_start"]},{$value["block_end"]},{$value["org"]},{$value["country"]},{$value["netname"]},{$value["description"]},{$value["remarks"]},{$value["status"]},{$value["created"]},{$value["modified"]}\n";
}

file_put_contents("Ripe_allocations.csv", $result, FILE_APPEND);


echo "dump_ripe_as\n";
$query = $db->prepare("SELECT id, org, sponsoring_org, description, remarks, created, modified FROM dump_ripe_as_$table ORDER BY id ASC");
$query->execute();
$data = $query->fetchAll();
$result = "";

file_put_contents("Ripe_AS.csv", "id,org,sponsoring_org,description,remarks,created,modified\n");

foreach ($data as $value) {
	$value = array_map(function($a) { return str_replace("\n", " ", str_replace("\r", " ", str_replace(",", "", trim($a)))); }, $value);
	
	$result .= "{$value["id"]},{$value["org"]},{$value["sponsoring_org"]},{$value["description"]},{$value["remarks"]},{$value["created"]},{$value["modified"]}\n";
}

file_put_contents("Ripe_AS.csv", $result, FILE_APPEND);


echo "dump_ripe_as_peers\n";
$query = $db->prepare("SELECT asn, peer FROM dump_ripe_as_peers_$table ORDER BY id ASC");
$query->execute();
$data = $query->fetchAll();
$result = "";

file_put_contents("Ripe_AS_peers.csv", "asn,peer\n");
foreach ($data as $value) {
	$result .= "{$value["asn"]},{$value["peer"]}\n";
}

file_put_contents("Ripe_AS_peers.csv", $result);



echo "dump_ripe_organisations\n";
$query = $db->prepare("SELECT org, name, is_lir, created, modified FROM dump_ripe_organisations_$table ORDER BY id ASC");
$query->execute();
$data = $query->fetchAll();
$result = "";

file_put_contents("Ripe_organizations.csv", "org,name,is_lir,created,modified\n");
foreach ($data as $value) {
	$value = array_map(function($a) { return str_replace("\n", " ", str_replace("\r", " ", str_replace(",", "", trim($a)))); }, $value);
	
	$result .= "{$value["org"]},{$value["name"]},{$value["is_lir"]},{$value["created"]},{$value["modified"]}\n";
}

file_put_contents("Ripe_organizations.csv", $result, FILE_APPEND);


echo "dump_ripe_routes\n";
$query = $db->prepare("SELECT version, block, block_start, block_end, description, origin, created, modified FROM dump_ripe_routes_$table ORDER BY id ASC");
$query->execute();
$data = $query->fetchAll();
$result = "";

file_put_contents("Ripe_routes.csv", "version,block,block_start,block_end,description,origin,created,modified\n");
foreach ($data as $value) {
	$result .= "{$value["version"]},{$value["block"]},{$value["block_start"]},{$value["block_end"]},{$value["description"]},{$value["origin"]},{$value["created"]},{$value["modified"]}\n";
}

file_put_contents("Ripe_routes.csv", $result, FILE_APPEND);


echo "zip\n";

$zip = new ZipArchive();
$zip->open("Db.zip", ZipArchive::CREATE);
$zip->addFile("AS.csv");
$zip->addFile("Blocks.csv");
$zip->addFile("Lir.csv");
$zip->addFile("Ripe_allocations.csv");
$zip->addFile("Ripe_AS.csv");
$zip->addFile("Ripe_AS_peers.csv");
$zip->addFile("Ripe_organizations.csv");
$zip->addFile("Ripe_routes.csv");
$zip->close();

unlink("AS.csv");
unlink("Blocks.csv");
unlink("Lir.csv");
unlink("Ripe_allocations.csv");
unlink("Ripe_AS.csv");
unlink("Ripe_AS_peers.csv");
unlink("Ripe_organizations.csv");
unlink("Ripe_routes.csv");

$folder = time()."-".sha1(microtime(1).random_bytes(32).uniqid());
file_put_contents("Core/zip-db", $folder);

mkdir("Public/$folder/");
rename("Db.zip", "Public/$folder/Db.zip");