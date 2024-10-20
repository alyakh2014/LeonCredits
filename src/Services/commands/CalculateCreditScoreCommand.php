<?php

namespace App\Services;

use App\Entity\Client\Client;

class CalculateCreditScoreCommand extends Command {

    public function __construct(Client $client) {
        $this->client = $client;
    }

    protected function doExecute() {
        echo "Рассчитываем кредитный рейтинг для {$this->data}\n";
        // Реализация логики расчета кредитного рейтинга
    }
}
