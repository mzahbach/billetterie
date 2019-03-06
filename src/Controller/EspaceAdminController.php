<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EvenementRepository;

class EspaceAdminController extends AbstractController
{
    /**
     * @Route("/espace/admin", name="espace_admin")
     */
    public function index(EvenementRepository $evenementRepository )
    {
        return $this->render('espace_admin/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);

    }
    

}

