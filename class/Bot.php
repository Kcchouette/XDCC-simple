<?php

class Bot implements JsonSerializable {

	private $name = "";
	private $xml = "";

	function __construct($n, $x) {
		$this->name = $n;
		$this->xml = $x;
	}

	public function getName() {
		return $this->name;
	}

	public function getXmlFile() {
		return $this->xml;
	}

	public function jsonSerialize() {
		return [
			'name' => $this->name,
			'xml' => $this->xml
		];
	}
}

?>