<?php

namespace App\Services;

use App\Entity\Client\Client;

class CalculateCreditAddressScoreCommand extends Command {

    protected function doExecute(Client $client) {
        $address = $client->getAddress();
        $state = $address->getState();
        switch ($state) {
            case ('CA'):
            case ('NV'): $this->clientScore +=100; break;
            case ('NY'): $this->clientLoan = (bool)rand(0, 1); break;
            default: $this->clientLoan = false;
        }
    }
}
