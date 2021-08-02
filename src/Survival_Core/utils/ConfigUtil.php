<?php

declare(strict_types=1);

namespace Survival_Core\utils;

use pocketmine\utils\Config;

class ConfigUtil {

    private static $values = [];

    public static function init(Config $config) : void {
        self::$values = $config->getAll();
    }

    public static function getValue(string $key) {
        return self::$values[$key] ?? null;
    }
}
