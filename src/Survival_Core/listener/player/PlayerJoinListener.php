<?php

namespace Survival_Core\listener\player;

use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\event\Listener;
use Survival_Core\utils\Utils;
use Survival_Core\Main;

class PlayerJoinListener implements Listener {

    public function messageOnJoin(PlayerJoinEvent $e) {

        $player = $e->getPlayer();
        $nick = $player->getName();
        $e->setJoinMessage(" ");
        foreach($player->getServer()->getOnlinePlayers() as $p){ 
             if ($player->hasPlayedBefore()) {
                  $p->sendMessage(Utils::getFromConfig("message-join", false, $nick));
             } else {
                  $p->sendMessage(Utils::getFromConfig("message-join-first-time", false, $nick));
             }
        }
        
    }
}
