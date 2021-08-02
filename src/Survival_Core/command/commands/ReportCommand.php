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

class ReportCommand extends BaseCommand {

    public function __construct() {
        parent::__construct("zglos", "komenda zglos", ["report"], true, false);
    }

    public function onCommand(CommandSender $sender, array $args) : void {
         $nick = $sender->getPlayer()->getName();
 
         isset(Main::$reportCooldown[$nick]) ? $time = Main::$reportCooldown[$nick] : $time = 0;

        if (time() - $time < 30) {
             $msgTime = (30 - (time() - $time));
             $sender->sendMessage(Utils::getFromConfig("message-report-cooldown", true, $msgTime));
            return;
        } else
            
            
         if(empty($args[0])) {
              $sender->sendMessage(Utils::getFromConfig("message-report-use", true));
         }
         
         $message = trim(implode(" ", $args));
         
         if(isset($args[0])) {
              $sender->sendMessage(Utils::getFromConfig("message-report-succes", true));
              Main::$reportCooldown[$nick] = time();
              if($sender->hasPermission("SurvivalCore.helpop.visible")) {
                   foreach($sender->getServer()->getOnlinePlayers() as $p){ 
                        $p->sendMessage(Utils::getFromConfig("report-message-admin", false, $nick, $message));
                   }
              }
         }
    }
}