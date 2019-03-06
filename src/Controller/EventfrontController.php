<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\EvenementRepository;



class EventfrontController extends AbstractController
{
    /**
     * @Route("/Evento", name="eventfront")
     */
    public function index(EvenementRepository $evenementRepository): Response
    {
        return $this->render('eventfront/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/liste_evenet", name="liste_evenet")
     */
    public function liste_evenet(EvenementRepository $evenementRepository): Response
    {
        return $this->render('eventfront/event.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }
}
