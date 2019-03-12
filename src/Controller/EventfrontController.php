<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\EvenementRepository;
use App\Entity\Evenement;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * @Route("/Evento")
 */
class EventfrontController extends AbstractController
{
    /**
     * @Route("/", name="eventfront")
     */
    public function index(EvenementRepository $evenementRepository): Response
    {  
        $event = new Evenement();
        $n=0;
        $now= (new \DateTime());
        
      //  dump($interval);
        
        $events = $evenementRepository->OrderByDate();
     
            $newEvnt = $evenementRepository->OrderByDate();
            dump($newEvnt);

                    $sEvent1=($events[0]);
                    $sEvent2=($events[1]);
                    $sEvent3=($events[2]);
            $interval = $now->diff($sEvent1->getDebutAt());
    
             
                
            
          
        
        return $this->render('eventfront/index.html.twig', [
            'evenements' => $events,
            'Sevent1' => $sEvent1,
            'Sevent2' => $sEvent2,
            'Sevent3' => $sEvent3,
            'interval' => $interval,

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
    /**
     * @Route("event/{id}", name="detailevent")
     */
     public function DetailEvent(Evenement $evenement):Response
     {
            return $this->render('eventfront/showEvent.html.twig',[
                'evenement' => $evenement,
            ]);
     }
}
