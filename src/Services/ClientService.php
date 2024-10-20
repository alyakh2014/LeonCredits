<?php

namespace App\Services;

use App\Entity\Client\Client;
use App\Entity\Traits\DataProccessTrait;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClientService
{
    use DataProccessTrait;

    private const USER_SET_PROPS = [
        'firstName' => 'setFirstName',
        'lastName' => 'setLastName',
        'birth' => 'setBirth',
        'ssn' => 'setSsn',
        'email' => 'setEmail',
        'phone' => 'setPhone',
        'state' => 'setState',
        'city' => 'setCity',
        'zip' => 'setZip'
    ];


    //todo install monolog logger
    private EntityManagerInterface $em;

    private LoggerInterface $logger;

    private $data = [];

    public function __construct(EntityManagerInterface $em, LoggerInterface $logger){
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * @throws \Exception
     */
    public function updateClient(\stdClass $data): JsonResponse
    {
        //todo add constraints and validate data
        $constrains = [];
        $response = new JsonResponse();
        try {
            $this->processClientData($data, $constrains);
            $client = $this->findClient($this->data);
            $this->updateClientData($client);
            $response->setData(['result' => true]);
            $response->setStatusCode(200);
        } catch (Exception $exception) {
            $response->setStatusCode($exception->getCode());
            $response->setData([
                'result' => false,
                'error' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ]);
            //todo put error down into the log file
        }

        return new JsonResponse([]);
    }

    private function processClientData(\stdClass $data, array $constrains)
    {
        $this->prepareData($data);
        $this->validateData($this->data, $constrains);
    }

    private function updateClientData(Client &$client)
    {
        foreach ($this->data as $key=>$value){
            if (isset($this::USER_SET_PROPS[$key])) $client->$this::USER_SET_PROPS[$key]($value);
        }
        $this->em->persist($client);
        $this->em->flush();
    }

    public function findClient(array $data)
    {
        if (!isset($data['email']) || !isset($data['ssn']))
            throw new \Exception('Email and SSN are expected');

        $client = $this->em->getRepository(Client::class)->findOneBy([
            'email' => $data['email'],
            'ssn' => $data['ssn']
        ]);

        if (!$client) $client = new Client();
        return $client;
    }
}