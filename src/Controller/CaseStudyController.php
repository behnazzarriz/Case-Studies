<?php

namespace App\Controller;

use App\Entity\CaseStudy;
use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/case-study')]
class CaseStudyController extends AbstractController
{
    #[Route('/', name: 'app_case_study')]
    public function index(): Response
    {
        return $this->render('case_study/index.html.twig', [
            'controller_name' => 'CaseStudyController',
        ]);
    }

    #[Route('/delete/{id}', name: 'delete_caseStudy')]
    public function delete(
        Request $request, CaseStudy $caseStudy, EntityManagerInterface $entityManager
    ): Response
    {
        $entityManager->remove($caseStudy);
        $entityManager->flush();
        return $this->redirectToRoute('list_customer');

    }

}

