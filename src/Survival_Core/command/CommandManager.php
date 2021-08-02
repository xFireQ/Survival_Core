<?php

namespace Survival_Core\command;

use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

use Survival_Core\command\commands\{
	HelpCommand,
	ReportCommand,
	SayCommand
};

class CommandManager {
	
	public static function init() {
	    
	    $unregisterCommands = [
	        "say",
            "help",
            "?",
            "gc"
        ];

        foreach($unregisterCommands as $commandName) {
            $command = Server::getInstance()->getCommandMap()->getCommand($commandName);

            if($command === null)
                continue;

            Server::getInstance()->getCommandMap()->unregister($command);
            
            
        }
        
	    
		$cmd = [
		 new HelpCommand(),
		 new ReportCommand(),
		 new SayCommand()
		];
		
		Server::getInstance()->getCommandMap()->registerAll("CoreS", $cmd);
	}
	
	
}