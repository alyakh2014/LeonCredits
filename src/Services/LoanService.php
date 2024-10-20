<?php

namespace App\Services;

use App\Entity\Traits\DataProccessTrait;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoanService
{
    use DataProccessTrait;

    //todo install monolog logger
    private CommandManager $commandManager;
    private array $data = [];
    private ClientService $clientService;

    public function __construct(CommandManager $commandManager, ClientService $clientService, Container $container){
        $this->commandManager = $commandManager;
        $this->clientService = $clientService;
        $this->commandManager->addCommands([
            $container->get(CalculateCreditAgeScoreCommand::class),
            $container->get(CalculateCreditAddressScoreCommand::class),
            $container->get(CalculateCreditIncomeScoreCommand::class),
            $container->get(CalculateCreditScoreCommand::class)
        ]);
    }

    public function checkLoan(\stdClass $data): JsonResponse
    {
        //todo add constraints and validate data
        $constrains = [];
        $response = new JsonResponse();

        try {
            $this->prepareData($data);
            $this->validateData($this->data, $constrains);
            $client = $this->clientService->findClient($data);
            $this->commandManager->executeAllCommands($client);

            $response->setData(['result' => true]);
            $response->setStatusCode(200);
        } catch (\Exception $exception) {
            $response->setStatusCode($exception->getCode());
            $response->setData([
                'result' => false,
                'error' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ]);
            //todo put error down into the log file
        }

        return $response;
    }
}