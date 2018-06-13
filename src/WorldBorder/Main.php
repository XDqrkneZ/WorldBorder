<?php

namespace WorldBorder;

use pocketmine\command\{
    CommandExecuter
};
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("\n\nWorldBorder by ArceusMatt\n\n");
    }

    public function onMove(PlayerMoveEvent $event)
    {
        $x = $this->getConfig()->get("x");
        $z = $this->getConfig()->get("z");
        $message = $this->getConfig()->get("message");
        /* player's current XZ */
        $xp = $event->getPlayer()->getFloorX();
        $zp = $event->getPlayer()->getFloorZ();
        /* default spawn's XZ */
        $xs = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getFloorX() + x;
        $zs = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getFloorZ() + z;
        /* the magic */
        $x1 = abs($xp);
        $z1 = abs($zp);
        $x2 = abs($xs);
        $z2 = abs($zs);
        /* checking if player XZ is greater than spawn XZ+config XZ */
        if ($x1 >= $x2) {
            $event->getPlayer()->sendMessage($message);
            $event->setCancelled();
        }
        if ($z1 >= $z2) {
            $event->getPlayer()->sendMessage($message);
            $event->setCancelled();
        }
    }
}
