<?php
class Client extends Thread {
	public $ip, $result;
	
	public function __construct(string $ip) {
		$this->ip = $ip;
	}
	
	public function run() {
		$this->result = gethostbyaddr($this->ip);
	}
}

$threads = [];

for ($i = 0; $i <= 255; $i++) {
	$threads[$i] = new Client("45.95.114.$i");
	$threads[$i]->start();
}

foreach ($threads as $thread) {
	$thread->join();
}

foreach ($threads as $thread) {
	echo "{$thread->ip} = {$thread->result}\n";
}