<?php

namespace App\Controller\Api;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class CustomerController extends AbstractController
{
    public function __construct(
    )
    {
    }

    #[Route('/api/customers/{id}', name: 'app_api_customers_read', methods: ['GET'])]
    public function read(Customer $customer): JsonResponse
    {
        return $this->json($customer);
    }
}
