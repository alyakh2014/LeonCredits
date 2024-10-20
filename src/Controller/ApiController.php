<?php

use App\Services\CalculateCreditScoreCommand;
use App\Services\ClientService;
use App\Services\CommandManager;
use App\Services\LoanService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ApiController extends AbstractController
{

    /**
     * Data from the front to create user: firstName, lastName, birth, ssn, email, phone, state, city, zip
     * @throws Exception
     */
    #[Route('/client-create', name: 'client-create', methods: ['POST'])]
    public function createUser(Request $request, ClientService $clientService): JsonResponse
    {
        $data = $request->getContent();
        return $clientService->updateClient($data);
    }

    /**
     * Data from the front to update user:
     * firstName, lastName, email, phone, state, city, zip, income.
     * When update user - email and ssn are expected
     * @throws Exception
     */
    #[Route('/client-update', name: 'client-update', methods: ['POST'])]
    public function updateUser(Request $request, ClientService $clientService): JsonResponse
    {
        $data = $request->getContent();
        return $clientService->updateClient($data);
    }

    //Calculate a possibility to give a credit to user and put it in db table
    #[Route('/check-loan', name: 'check-loan', methods: ['POST'])]
    public function getProfessionCategories(Request $request, LoanService $loanService): JsonResponse
    {
        $data = $request->getContent();
        return $loanService->checkLoan($data);
    }
}