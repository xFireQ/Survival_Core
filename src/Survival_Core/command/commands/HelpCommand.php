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

class HelpCommand extends BaseCommand {

    public function __construct() {
        parent::__construct("pomoc", "komenda pomoc", ["?", "help"], false, false);
    }

    public function onCommand(CommandSender $sender, array $args) : void {
        $sender->sendMessage(Utils::getFromConfig("message-help", false));
    }
}
