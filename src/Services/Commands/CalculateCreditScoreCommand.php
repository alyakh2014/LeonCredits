<?php

namespace App\Services;

use App\Entity\Client\Client;

class CalculateCreditScoreCommand extends Command {

    protected function doExecute(Client $client) {
        if ($this->clientLoan) $this->clientScore += 250;
    }
}
