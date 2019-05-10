<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Category;
use App\Form\EvenementType;
use App\Form\CategoryType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\CategoryPriceRepository;
use Proxies\__CG__\App\Entity\CategoryPrice;

/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/", name="evenement_index", methods={"GET"})
     */
    public function index(EvenementRepository $evenementRepository,CategoryRepository $categoryRepository): Response
    {
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
            'catygorys' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request, ObjectManager $manager,CategoryPriceRepository $packRepo,EvenementRepository $eventRepo): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$evenement->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$fileName);
            $evenement->setImage($fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();
            $event= $eventRepo->findOneBy([ 'titre' => $evenement->getTitre(),
                                            'debutAt'=> $evenement->getDebutAt(),
            ]);

            $pack = new CategoryPrice();
            $pack->setTitre('tarif Standar');
            $pack->setDiscount(0);
            $pack->setEvent($event);
            $manager->persist($pack);
            $manager->flush();
            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="evenement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evenement $evenement): Response
    {
        
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $evenement->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $evenement->setImage($fileName);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_index', [
                'id' => $evenement->getId(),
            ]);
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evenement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Evenement $evenement,CategoryPriceRepository $catPRepo): Response
    {
        /*$catP= $catPRepo->find()

        $evenement->getId();*/
        $catps= $catPRepo->findBy([ 'event'=>$evenement]);
        dump($catps);
        foreach ($catps as $catp) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($catp);
            $entityManager->flush();
        }
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evenement_index');
    }



}
