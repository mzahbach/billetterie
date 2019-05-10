<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EvenementRepository;
use App\Repository\CategoryPriceRepository;
use App\Repository\CommentRepository;
use App\Repository\FactureRepository;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\NotificationRepository;

class DashbordController extends AbstractController
{
    /**
     * @Route("/dashbord", name="dashbord")
     */
    public function index(EvenementRepository $eventRepo,CategoryPriceRepository $catRepo , CommentRepository $commentRepo ,FactureRepository $factRepo)
    {
        $now = (new \DateTime());
        
        $nbrevent= count($eventRepo->findAll());
        foreach ( $eventRepo->findAll() as $event) {
            if ($event->getDebutAt()->format('m-Y') === $now->format('m-Y')) {
                $EventMs[] = $event;
            }
        }
        $eventcent= count($EventMs)*100;
        $eventcent=$eventcent/$nbrevent;
        $eventcent=intval($eventcent);
        dump($eventcent);
        $nbrFacture= count($factRepo->findAll());
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
        $nbrUser = count($users);
        $nbrComment = count($commentRepo->findAll());

        return $this->render('dashbord/index.html.twig', [
            'nbrevent' => $nbrevent,
            'nbrFacture' => $nbrFacture,
            'nbrUser' => $nbrUser,
            'nbrComment' => $nbrComment,
            'eventCent' => $eventcent
        ]);
    }


    /**
     * function pour afficher la liste des message pour l admin dans la dashbord
     *
     * @Route("/contactAs", name="ContactAdmin")
     * 
     * 
     * @param NotificationRepository $notifRepo
     * @return Response
     */
    public function contactAs(NotificationRepository $notifRepo):Response
    {
        $messages = $notifRepo->findOrderByDESC();
        $output = null;
    
        /*foreach ( $messages as $msg) {
            $output[]=[
                 'id' => $msg->getId(),
                 'nom'=> $msg->getNom(),
                 'email'=> $msg->getEmail(),
                 'object' => $msg->getSubject(),
                 'message'=> $msg->getMessage()
            ];
        }*/

        if (count($messages)>0) {
            foreach ($messages as $msg) {
                $output .= '<li class="left clearfix"><span class="chat-img pull-left">
                                        <img src="http://placehold.it/60/30a5ff/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header"><a href="http://www.gmail.com"><strong class="primary-font">'. strval($msg->getNom()). '</strong></a> <small
                                                class="text-muted">'. strval($msg->getEmail()) .'</small></div>
                                        <p>'.strval($msg->getSubject()).'</p>
                                    </div>
                                </li>';
            }
        }



        $response = new Response(json_encode($output));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
        
    }
}
