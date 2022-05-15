<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Service\MyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private MyService $service;
    private CustomerRepository $customerRepository;
    
    public function __construct(MyService $myService, CustomerRepository $customerRepository)
    {
        $this->service = $myService;
        $this->customerRepository = $customerRepository;
    }
    
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        $aggregateData = $this->customerRepository->totallingThePriceOrMore(1500);
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'calculated_value' => $this->service->calcAdd(1, 1),
            'aggregated_value' => $aggregateData,
        ]);
    }
}
