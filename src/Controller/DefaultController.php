<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'blog_list')]
    public function index(CustomerRepository $customerRepository): Response
    {
        $allCustomers = $customerRepository->findBy(['status' => true], ['id' => 'DESC']);
        return $this->render('default/index.html.twig', [
            'customers' => $allCustomers,
        ]);
    }
}
