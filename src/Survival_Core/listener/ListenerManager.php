<?php

namespace Survival_Core\listener;

use Survival_Core\listener\player\PlayerJoinListener;
use Survival_Core\Main;

final class ListenerManager {

    private function __construct() { }

    public static function init(Main $main)  {
        $listeners = [
            new PlayerJoinListener()
        ];

        foreach($listeners as $listener) {
            $main->getServer()->getPluginManager()->registerEvents($listener, $main);
        }
    }
}
