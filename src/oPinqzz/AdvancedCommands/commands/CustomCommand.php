<?php


namespace oPinqzz\AdvancedCommands\commands;

use Closure;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;

final class CustomCommand extends Command {

    private Closure $executionFunction;

    public function __construct(String $command_name, 
        String $command_description, 
        String $command_permission, 
        String $command_usage_msg = null, 
        String $command_permission_msg = null, 
        Array $command_aliases = null, 
        String $permission_allowed, 
        Closure $executionFunction
    ){
        parent::__construct($command_name, $command_description, $command_usage_msg, $command_aliases);
        $permission = new Permission($command_permission);
        // $perm_allowed = new Permission($permission_allowed);
        DefaultPermissions::registerPermission($permission);
        parent::setPermission($command_permission);
        if($command_permission_msg != null) {
            parent::setPermissionMessage($command_permission_msg);
        }
        $this->executionFunction = $executionFunction;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        ($this->executionFunction)($sender, $args);
    }


}