<?php

namespace App\Services;

use App\Entity\Client\Client;

class CommandManager {
    private $commands = [];

    public function addCommand(Command $command) {
        $this->commands[] = $command;
    }

    public function addCommands(array $commands){
        foreach ($commands as $command) {
            if ($command instanceof Command){
                $this->addCommand($command);
            }
        }
    }

    public function executeAllCommands(Client $client) {
        foreach ($this->commands as $command) {
            $command->execute($client);
        }
    }
}