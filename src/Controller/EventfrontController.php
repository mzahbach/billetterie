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
use App\Entity\Panier;
use App\Form\PanierType;
use App\Repository\CategoryPriceRepository;
use App\Entity\CategoryPrice;
use App\Repository\PostLikeRepository;
use App\Entity\PostLike;
use App\Repository\PanierRepository;

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
        

       

                
        
        $categorys = $catRepo->findAll();

        $events = $event->OrderByDate(); 
        $sEvent1=($events[0]);
        $sEvent2=($events[1]);
        $sEvent3=($events[2]);
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
                    
               
                    if ($date=="null") {
                        return $this->render('eventfront/searchEvent.html.twig',[
                            'categorys' => $categorys,
                            'archives' => $EventMs,
                            'eventsdate' => $events,
                            'event1' => $sEvent1,
                            'event2' =>$sEvent2,
                            'event3' =>$sEvent3
                            
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
                                'date' => $date,
                                'event1' => $sEvent1,
                                'event2' =>$sEvent2,
                                'event3' =>$sEvent3
                                
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
                            'date' => $date,
                            'event1' => $sEvent1,
                            'event2' =>$sEvent2,
                            'event3' =>$sEvent3
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
     * @Route("Pack/{id}", name="PackEvent")
     */
    public function PackEvent(Evenement $evenement,EvenementRepository $eventRepo,CategoryPriceRepository $catPRepo, Request $request):Response
    {
           $panier = new Panier();
           $catsPs=$catPRepo->findbyEvent($evenement);
           foreach ($catsPs as $cat) {
           
            $form = $this->createForm(PanierType::class, $panier);
            $form->handleRequest($request);
            $cat->setForm($form);
           }
         
        return $this->render('eventfront/PackEvent.html.twig',[
            "evenement" => $evenement,
            "pack" => $catsPs
            
        ]);
    }
    /**
     * ajouter nombre de pack a achetee 
     *
     * @Route("/add/{id}/panier" ,name="ajouterNbr")
     * 
     * @param CategoryPrice $catP
     * @param ObjectManager $manager
     * @param CategoryPriceRepository $catPRepo
     * @return Response
     */
    public function NbrPanier($id,CategoryPrice $catP, ObjectManager $manager , CategoryPriceRepository $catPRepo, PanierRepository $PRepo):Response{
        
        $pack=$catPRepo->find($id);
        dump($pack);
        $panier = new Panier();
        $user = $this->getUser();
        if (!$user) {
            return $this->json([
                'code'=>403,
                'message'=> 'il faut étre connectee'
            ],403);
        }else{
            $panier->setPack($pack);
            $panier->setUsers($user);
            $panier->setNbrPlace(1);
            $panier->setActive(true);
            $manager->persist($panier);

            $manager->flush();

            return $this->json(['message' => 'ca marche ',
                'nbrPack' => $PRepo->count([
                    'pack' => $pack,
                    'Active' => true
                ])
        ], 200);
        }
        
        
    }

    /**
     * FActuration et envoi a la base la facture ou faire une anulation
     * 
     * @Route("/detail/{id}", name="detailFacture")
     *
     * @param Evenement $evenement
     * @param Request $request
     * @return Response
     */
    public function DetailPanier( $id,Evenement $evenement, Request $request, CategoryPrice $cat,CategoryPriceRepository $catRepo,Panier $panier, PanierRepository $panierRepo):Response{
        return $this->render( 'eventfront/DetailPanier.html.twig');
    }

    /**
     * Undocumented function supprimer un event du panier
     *
     * @Route("/supp/{id}/panier", name="suppEP")
     * 
     * @param [type] $id
     * @param CategoryPrice $catP
     * @param ObjectManager $manager
     * @param CategoryPriceRepository $catPRepo
     * @return Response
     */
    public function SuppNbrPanier($id, CategoryPrice $catP, ObjectManager $manager, CategoryPriceRepository $catPRepo, PanierRepository $PRepo): Response
    {

        $pack = $catPRepo->find($id);
        dump($pack);
        $panier = new Panier();
        $user = $this->getUser();
        if (!$user) {
            return $this->json([
                'code' => 403,
                'message' => 'il faut étre connectee'
            ], 403);
        } else {
            $panier = $PRepo->findOneBy([
                'pack' => $pack,
                'users' => $user,
                ]);

               $manager->remove($panier);
               $manager->flush();

            return $this->json([
                'code' => '200',
                'message' => 'event supprimer du panier ',
                'nbrPack' => $PRepo->count(['pack'=>$pack ,
                                            'Active'=> true                           
                ]),
            ], 200);
        }
    }



    /**
     * @Route("event/{id}", name="detailevent")
     */
     public function DetailEvent(Evenement $evenement,Request $request):Response
     {
        $comment =new Comment();
        $user = $this->getUser();
        $formEvent = $this->createForm(CommentType::class,$comment);
        $formEvent->handleRequest($request);
        
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
    

    /**
     * premet de liker et unliker un event  
     *
     * @Route("/post/{id}/like", name="post_like")
     * 
     * @param Evenement $event
     * @param ObjectManager $manager
     * @param PostLikeRepository $likeRepo
     * @return Response
     */
    public function like (Evenement $event,ObjectManager $manager, PostLikeRepository $likeRepo):Response{
        $user = $this->getUser();
        if (!$user) {
            return $this->json([
                'code'=> 403,
                'message'=>"unauthorized"
            ],403);

        }if ($event->isLikedByUser($user)) {
            $like = $likeRepo->findOneBy([
                'post' => $event,
                'user' => $user
            ]);
            $manager->remove($like);
            $manager->flush();
            return $this->json([
                'code' => 200,
                'message' => "like supprimer",
                'likes' => $likeRepo->count(['post' => $event])
            ],200);
        }
        $like = new PostLike();
        $like->setPost($event)
             ->setUser($user);

        $manager->persist($like);
        $manager->flush();

        return $this->json(['code'=> 200 ,
        'message'=>'like ajouter ',
        'likes'=>$likeRepo->count(['post' => $event])
    ],200);
    }


}


