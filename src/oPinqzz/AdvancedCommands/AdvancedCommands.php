<?php


namespace oPinqzz\AdvancedCommands;

use pocketmine\command\SimpleCommandMap;
use pocketmine\plugin\PluginBase;

final class AdvancedCommands {

    private static $Plinstance;

    public function __construct(PluginBase $plugin) {
        self::$Plinstance = $plugin;
        
    }
    
    public static function getPlInstance() : PluginBase {
        return self::$Plinstance;
    }
    

}