<?php

declare(strict_types=1);

namespace Survival_Core;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use Survival_Core\command\player\HelpCommand;
use Survival_Core\command\player\ReportCommand;
use Survival_Core\command\admin\SayCommand;
use Survival_Core\listener\player\PlayerJoinListener;

class Main extends PluginBase {

    private static $instance;

    private $pluginConfig;

    public static function getInstance() : self {
        return self::$instance;
    }

    public function onEnable() : void {
        self::$instance = $this;

        $this->saveResource("config.yml");

        $this->pluginConfig = new Config($this->getDataFolder() . "config.yml", Config::YAML);

        $this->initCommands();
        $this->initListeners();

        $this->getLogger()->info("Plugin enabled!");
    }

    private function initCommands() : void {
        $commandMap = $this->getServer()->getCommandMap();

        $unregisterCommands = [
            "say",
            "help",
            "?",
            "gc"
        ];

        foreach($unregisterCommands as $commandName) {
            $command = $commandMap->getCommand($commandName);

            if($command === null) {
                continue;
            }

            $commandMap->unregister($command);
        }

        $commands = [
            new HelpCommand(),
            new ReportCommand(),
            new SayCommand()
        ];

        $commandMap->registerAll("CoreS", $commands);
    }

    private function initListeners() : void {
        $listeners = [
            new PlayerJoinListener()
        ];

        foreach($listeners as $listener) {
            $this->getServer()->getPluginManager()->registerEvents($listener, $this);
        }
    }

    public function getPluginConfig() : Config {
        return $this->pluginConfig;
    }
}
