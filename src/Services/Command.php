<?php

namespace App\Services;

use App\Entity\Client\Client;

abstract class Command {

    protected int $clientScore = 0;
    protected bool $clientLoan = true;

    protected $executed = false;

    public function execute(Client $client) {
        if (!$this->executed) {
            $this->doExecute($client);
            $this->executed = true;
        }
    }

    abstract protected function doExecute(Client $client);
}