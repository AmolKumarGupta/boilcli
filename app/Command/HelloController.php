<?php 
namespace App\Command;

use Boilcli\CommandController;

class HelloController extends CommandController{
	public function run($argv)
	{
		$name = isset($argv[2]) ? $argv[2] : "World";
		$this->getApp()->getPrinter()->out("hey $name ///controller");
	}
}