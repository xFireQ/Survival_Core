<?php

namespace Survival_Core;

use pocketmine\Server;

use pocketmine\plugin\PluginBase;

use Survival_Core\utils\Utils;
use Survival_Core\utils\ConfigUtil;
use Survival_Core\listener\ListenerManager;
use pocketmine\utils\Config;

use Survival_Core\command\CommandManager;

class Main extends PluginBase {
    
    public static $reportCooldown = [];

    private static $instance;
    private $Config;
    
    public function getInstance() : Main {
        return self::$instance;
    }
    

    public function onEnable() : void {
        self::$instance = $this;

        $this->init();
    }

    
    private function init() : void {
        self::$instance = $this;

        $this->saveResource("Config.yml");
        $this->Config = new Config($this->getDataFolder() . "Config.yml", Config::YAML);
        
        CommandManager::init();
        ListenerManager::init($this);
        ConfigUtil::init($this->Config);
    }
    
    
}
