<?php

class Bookmark implements JsonSerializable {

	private $name = "";
	private $search = "";
	private $bot = "";

//we can only have 1 constructor
	function __construct($n, $s, $b = "") {
		$this->name = $n;
		$this->search = $s;
		$this->bot = $b;
	}

	public function getName() {
		return $this->name;
	}

	public function getStringSearch() {
		return $this->search;
	}

	public function getBotSearch() {
		return $this->bot;
	}

	public function jsonSerialize() {
		return [
			'name' => $this->name,
			'search' => $this->search,
			'bot' => $this->bot
		];
	}
}

?>