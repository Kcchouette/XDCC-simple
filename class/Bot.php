<?php

class Bot implements JsonSerializable {

	private $name = "";
	private $xml = "";
	private $website = "";
	private $irc = "";

//we can only have 1 constructor
	function __construct($n, $x, $wb = "", $irc = "") {
		$this->name = $n;
		$this->xml = $x;
		$this->website = $wb;
		$this->irc = $irc;
	}

	public function getName() {
		return $this->name;
	}

	public function getXmlContent() {
		return $this->xml;
	}

	public function getWebsite() {
		return $this->website;
	}

	public function getIRC() {
		return $this->irc;
	}

	public function jsonSerialize() {
		return [
			'name' => $this->name,
			'xml' => $this->xml,
			'website' => $this->website,
			'irc' => $this->irc
		];
	}
}

?>