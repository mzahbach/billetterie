<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\EvenementRepository;
use App\Entity\Evenement;
use App\Entity\Post;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Migrations\Events;
use App\Entity\Comment;
use App\Entity\User;
use App\Form\CommentType;


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
    public function liste_evenet(EvenementRepository $evenementRepository ,Request $request): Response
    {       
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form -> handleRequest($request);
        $time = new \DateTime();
        $EventMs=null;
        
        dump(isset($search->getTitreSearch));
         $eventsResult = $evenementRepository->findBytitre($search);
            if (  isset($search->getTitreSearch) ) {

                $events = $evenementRepository->findAll();  
                foreach ($events as $event) {
                    if($event->getDebutAt()->format('m-Y')=== $time->format('m-Y') )
                    {
                        $EventMs[]=$event;
                       
                    }
                }
               
                return $this->render('eventfront/event.html.twig', [
                   'evenements' => $EventMs,
                   'form' => $form->createView()
                ]); 
                }else{
                    dump('1111');
                return $this->render('eventfront/event.html.twig', [
                    'evenements' => $eventsResult,
                    'form' => $form->createView()
                    
                ]);
                
            }
        

        
    }

   /**
    * @Route("/search/{date}/{id}" , defaults={"date" = null},defaults={"id" = null}, name="searchEvent")
    *
    * @param EvenementRepository $event
    * @return Response
    */
    public function SearchEvent( EvenementRepository $event, CategoryRepository $catRepo , $date,$id) :Response
    {
        

       dump($date);
       dump($date);
        
        $categorys = $catRepo->findAll();

        $events = $event->OrderByDate(); 
        $i=0; 
        $t=0;
       
            
        
                
                $EventMs[$i]=$events[0];
                $i++;
                
                    for ($j=1; $j <count($events) ; $j++) { 
                        if( $events[$j-1]->getDebutAt()->format('m-Y')!= $events[$j]->getDebutAt()->format('m-Y') )
                        {
                            $EventMs[$i]=$events[$j];
                            
                           
                        }
                    }
                    
               
                    if ($date==0) {
                        return $this->render('eventfront/searchEvent.html.twig',[
                            'categorys' => $categorys,
                            'archives' => $EventMs,
                            'eventsdate' => $events
                            
                        ]);
                    } elseif($date!= "null" AND $id!= "null"){
                            $eventDC= $event->findByCategiryDAt($catRepo->find($id) ,$date);
                            $evntDate=null ;
                            foreach ($eventDC as $event) {
                                if ($date==$event->getDebutAt()->format('m-Y')) {
                                     $evntDate[]=$event;
                                  }
                                  
                             }
                            
                            return $this->render('eventfront/searchEvent.html.twig',[
                                'categorys' => $categorys,
                                'archives' => $EventMs,
                                'eventsdate' => $evntDate,
                                'date' => $date
                                
                                ]);
                    } else {
                        
                        foreach ($events as $event) {
                            if ($date==$event->getDebutAt()->format('m-Y')) {
                                 $evntDate[]=$event;
                              }
                              
                         }
                         return $this->render('eventfront/searchEvent.html.twig',[
                            'categorys' => $categorys,
                            'archives' => $EventMs,
                            'eventsdate' => $evntDate,
                            'date' => $date
                        ]);
                    }


       

    }

    /**
     * Undocumented function
     *
     * @Route("/search/{date}/category" , name="categoryevent")
     * 
     * @param Post $post
     * @param ObjectManager $manager
     * @param CategoryRepository $catRepo
     * @return Response
     */
    public function CategoryRecherch( ObjectManager $manager,EvenementRepository $EventRepo ,CategoryRepository $catRepo,$date):Response{
        $catygoys= $catRepo->findAll();
        foreach ($catygoys as $cat) {
            $catgTitre[] = $cat->getTitre();
        }
        
        return $this->json([$catgTitre], 200);
    }



    /**
     * @Route("event/{id}", name="detailevent")
     */
     public function DetailEvent(Evenement $evenement,Request $request):Response
     {
        $comment =new Comment();
        $user = new User();
        $formEvent = $this->createForm(CommentType::class,$comment);
        $formEvent->handleRequest($request);
        dump($user->getId());
        if ($formEvent->isSubmitted() && $formEvent->isValid()) {
            $comment->setCreatedAt(new \DateTime());
            $comment->setUsers($user);
            $comment->setEvenement($evenement);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('detailevent',['id'=>$evenement->getId()]);
        }
        
            return $this->render('eventfront/showEvent.html.twig',[
                'evenement' => $evenement,
                'formEvent' => $formEvent->createView(),
            ]);
     }

     


     /**
     * @Route("search/{date}", name="SearchEventCatDate")
     */
    public function SearchByCatAndDateEvent(string $date, Evenement $evenement ,Category $cat,EvenementRepository $EventRepo ):Response
    {
        dump($date);
           return $this->render('eventfront/searchEvent.html.twig',[
               
           ]);
    }



}


