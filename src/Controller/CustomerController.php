<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerFormType;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/customer')]
class CustomerController extends AbstractController
{
    #[Route('/', name: 'list_customer')]
    public function list(
        CustomerRepository $customerRepository
    ): Response
    {

        $allCustomers = $customerRepository->findBy([], ['id' => 'DESC']);
        return $this->render('customer/index.html.twig', [
            'customers' => $allCustomers
        ]);
    }

    #[Route('/create', name: 'create_customer')]
    public function create(
        Request                $request,
        EntityManagerInterface $entityManager,
        SluggerInterface       $slugger
    ): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerFormType::class, $customer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customer);
            $entityManager->flush();
            $this->addFlash('success', 'New Customer added!');
            return $this->redirectToRoute('list_customer');
        }

        return $this->render('customer/create.html.twig', [
            'createCustomerForm' => $form->createView(),

        ]);

    }


    #[Route('/edit/{id}', name: 'edit_customer')]
    public function edit(
        Request                $request,
        EntityManagerInterface $entityManager,
        Customer               $customer
    ): Response
    {

        $form = $this->createForm(CustomerFormType::class, $customer);
        $form->handleRequest($request);

        $getFileName = $customer->getLogoName();


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($customer);
            $entityManager->flush();
            $this->addFlash('success', 'Customer edited!');
            return $this->redirectToRoute('list_customer');
        }
        return $this->render('customer/edit.html.twig', [
            'createCustomerForm' => $form->createView(),

        ]);

    }

    #[Route('/delete/{id}', name: 'delete_customer')]
    public function delete(
        Request $request, Customer $customer, EntityManagerInterface $entityManager
    ): Response
    {
        $entityManager->remove($customer);
        $entityManager->flush();
        $this->addFlash('success', 'Customer deleted!');
        return $this->redirectToRoute('list_customer');

    }


}
