<?php

namespace App\Services;

use App\Entity\Client\Client;

class CalculateCreditIncomeScoreCommand extends Command {

    protected function doExecute(Client $client) {
        //todo Calculate average income for the last year from DB
        $this->clientScore += 100;
    }
}
