<?php


namespace oPinqzz\AdvancedCommands\commands;

use Closure;
use LogicException;
use oPinqzz\AdvancedCommands\AdvancedCommands;
use pocketmine\permission\DefaultPermissions;
use pocketmine\lang\KnownTranslationFactory as l10n;
use pocketmine\permission\Permission;

final class CommandBuilder {

    private $command_name, $command_description, $command_permission, $command_usage_msg, $command_permission_message, $permission_allowed;
    private array $aliases;
    private Closure $execution;
    public const ALLOWED_ALL = DefaultPermissions::ROOT_USER;
    public const ALLOWED_OPERATOR = DefaultPermissions::ROOT_OPERATOR;
    public const ALLOWED_CONSOLE = DefaultPermissions::ROOT_CONSOLE;
    
    public function removeCommand(String|Array $commands) : void {
        new CommandRemoval($commands);
    }

    public function newCommand(String $command_name, String $command_description, String $command_usage_msg = null, String $command_permission_message = null, Array $command_aliases = null) : CommandBuilder {

        $this->command_name = $command_name;
        $this->command_description = $command_description;
        $this->command_usage_msg = $command_usage_msg;
        $this->command_permission_message = $command_permission_message;
        $this->aliases = $command_aliases;
        return $this;
    }

    public function setExecution(Closure $executionFunctions) : CommandBuilder {
        $this->execution = $executionFunctions;
        return $this;
    }

    public function build() {
        $this->register();
    }

    private function register() {
        if($this->execution == null) {
            new LogicException("Cannot Register Command Without Execution Functions", 125);
        } else if($this->command_name == null || $this->command_description == null || $this->command_permission == null) {
            new LogicException("Cannot Leave Any Command Data Null");
        } else {
            $plinstance = AdvancedCommands::getPlInstance();
            $command = new CustomCommand($this->command_name, $this->command_description, $this->command_permission, $this->command_usage_msg, $this->command_permission_message, $this->aliases, $this->permission_allowed, $this->execution);
            $plinstance->getServer()->getCommandMap()->register($this->command_name, $command);
        }

    }

    public function prepareCommandPermissions(String $command_permission, String $permission_allowed) : CommandBuilder {
        $consoleRoot = DefaultPermissions::registerPermission(new Permission(DefaultPermissions::ROOT_CONSOLE, l10n::pocketmine_permission_group_console()));
		$operatorRoot = DefaultPermissions::registerPermission(new Permission(DefaultPermissions::ROOT_OPERATOR, l10n::pocketmine_permission_group_operator()), [$consoleRoot]);
		$everyoneRoot = DefaultPermissions::registerPermission(new Permission(DefaultPermissions::ROOT_USER, l10n::pocketmine_permission_group_user()), [$operatorRoot]);

        switch($permission_allowed) {
            case self::ALLOWED_ALL:
                DefaultPermissions::registerPermission(new Permission($command_permission, null), [$everyoneRoot]);
            break;
            
            case self::ALLOWED_CONSOLE:
                DefaultPermissions::registerPermission(new Permission($command_permission, null), [$consoleRoot]);
            break;

            case self::ALLOWED_OPERATOR:
                DefaultPermissions::registerPermission(new Permission($command_permission, null), [$operatorRoot]);
            break;
        }

        $this->command_permission = $command_permission;
        $this->permission_allowed = $permission_allowed;


        return $this;
    }



}