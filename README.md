# AdvancedCommands 
A New Way To Create And Register Commands Easily
Written with easy code to be understandable, kinda of

# API Implementation
in onEnable,
- To Add A Command
```php
        new AdvancedCommands($this);
        $builder = new CommandBuilder();
        $builder->newCommand($command_name, $command_description, $command_usage_msg, $command_permission_msg, array $aliases)->setExecution(
            function(CommandSender $sender, Array $args) : void {
                $sender->sendMessage("TEST DONE BRO");
            }
        )->prepareCommandPermissions("test.permission", $builder::ALLOWED_OPERATOR)->build();
```

- To Remove A Command
```php
        new AdvancedCommands($this);
        $builder = new CommandBuilder();
        $builder->removeCommand("help");
```

You Cannot Resell This Library / Copyrights a reserved to oPinqzz
