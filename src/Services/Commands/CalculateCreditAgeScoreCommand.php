<?php

namespace App\Services;

use App\Entity\Client\Client;

class CalculateCreditAgeScoreCommand extends Command {

    protected function doExecute(Client $client) {
        $clientAge = $client->getAgeOfClient();

        if ($clientAge < 18 || $clientAge > 60) $this->clientLoan = false;
        else $this->clientScore += 100;
    }
}
