<?php



namespace oPinqzz\AdvancedCommands\commands;

use oPinqzz\AdvancedCommands\AdvancedCommands;

class CommandRemoval {


    public function __construct(Array|String $command_names)
    {
        $pl_instance = AdvancedCommands::getPlInstance();
        if(is_array($command_names)) {
            foreach($command_names as $command) {
                $pl_instance->getServer()->getCommandMap()->unregister($pl_instance->getServer()->getCommandMap()->getCommand($command));
            }
        } else {
            $pl_instance->getServer()->getCommandMap()->unregister($pl_instance->getServer()->getCommandMap()->getCommand($command_names));
        }     
    }

}