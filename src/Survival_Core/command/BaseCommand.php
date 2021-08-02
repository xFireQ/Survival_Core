<?php

declare(strict_types=1);

namespace Survival_Core\command;

use Survival_Core\util\ChatUtil;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use Survival_Core\Main;
use Survival_Core\utils\Utils;

abstract class BaseCommand extends Command {

      private $playerCommand;

    public function __construct(string $name, string $description, array $aliases = [], bool $playerCommand = false, bool $permission = false) {
        parent::__construct($name, $description, null, $aliases);

        $this->playerCommand = $playerCommand;

        if($permission)
            $this->setPermission("SurvivalCore.command.". $name);
            
    }

    public function execute(CommandSender $sender, string $label, array $args) : void {
        if($this->playerCommand && !$sender instanceof Player) {
            $sender->sendMessage("Tej komendy mozesz uzyc tylko w grze!");
            return;
        }

        $permission = $this->getPermission();

        if($permission !== null && !$sender->hasPermission($permission)) {
            $sender->sendMessage(Utils::getFromConfig("survival-core-permission-message", true, $permission));
            return;
        }

        $this->onCommand($sender, $args);
    }

    abstract public function onCommand(CommandSender $sender, array $args) : void;
}