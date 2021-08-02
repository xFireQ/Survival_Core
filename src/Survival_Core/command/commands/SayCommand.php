<?php

namespace Survival_Core\command\commands;

use pocketmine\{
    Server, Player
};

use Survival_Core\utils\Utils;

use pocketmine\command\{
    Command, CommandSender
};

use Survival_Core\Main;
use Survival_Core\command\BaseCommand;

class SayCommand extends BaseCommand {

    public function __construct() {
        parent::__construct("say", "komenda say", [], false, true);
    }

    public function onCommand(CommandSender $sender, array $args) : void {
         if(empty($args)) {
              $sender->sendMessage(Utils::getFromConfig("message-say-use", true));
         }
         
         if(isset($args[0])) {
              $msg = trim(implode(" ", $args));
              foreach($sender->getServer()->getOnlinePlayers() as $p){
                   for ($i = 0; $i < 3; $i++) {
                        $p->sendMessage(Utils::getFromConfig("message-say-chat", false, $msg));
                             
                        
                   }
              }
         
         }
    }
}