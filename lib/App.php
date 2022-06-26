<?php
namespace Boilcli;

class App{
	protected $printer;

	protected $command_registry ;

	public function __construct(){
		$this->printer = new CliPrinter();
		$this->command_registry = new CommandRegistry();
	}

	public function getPrinter(){
		return $this->printer;
	}

	public function registerController($name, CommandController $controller)
	{
		$this->command_registry->registerController($name, $controller);
	}

	public function registerCommand($name, $callable){
		$this->command_registry->registerCommand($name, $callable);
	}

	public function runCommand(array $argv = [], $defaultCommand = "hello" ){
		$command_name = $defaultCommand;

		if( isset($argv[1]) ){
			$command_name = $argv[1];
		}

		try{
			call_user_func($this->command_registry->getCallable($command_name), $argv);
		}catch (\Exception $e){
			$this->getPrinter()->out("ERROR: ". $e);
			exit;
		}
	}
}