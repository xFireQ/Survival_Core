<?php

namespace Survival_Core\utils;

use Survival_Core\Main;

class Utils{

    public static function getFormat() : string{
        return Main::getCfg()->get("format");
    }
    
    public static function getFromConfig(string $message, bool $prefix = true, string ...$vars) : string {
        $msg = self::format(str_replace("{LINE}", "\n", ConfigUtil::getValue($message)), $prefix);
        if(!empty($vars))
            $msg = self::fixVariables($msg, $vars);

        return $msg;
    }
    
     public static function format(string $message, bool $prefix = true) : string {
        if($prefix) {
            $format = ConfigUtil::getValue("message-format");

            return self::fixColors(str_replace("{MESSAGE}", $message, $format));
        } else
            return self::fixColors($message);
    }
    
    public static function fixColors(string $message) : string {
        $message = str_replace('%C', ConfigUtil::getValue("message-color"), $message);

        return str_replace('&', '§', $message);
    }
    
    public static function fixVariables(string $message, array $vars) : string {
        foreach($vars as $key => $var)
            $message = str_replace("{%".$key."}", $var, $message);

        return $message;
    }
}