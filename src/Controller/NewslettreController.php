<?php

namespace App\Controller;

use App\Entity\Newslettre;
use App\Form\NewslettreType;
use App\Repository\NewslettreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/newslettre")
 */
class NewslettreController extends AbstractController
{
    /**
     * @Route("/", name="newslettre_index", methods={"GET"})
     */
    public function index(NewslettreRepository $newslettreRepository): Response
    {
        return $this->render('newslettre/index.html.twig', [
            'newslettres' => $newslettreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="newslettre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $newslettre = new Newslettre();
        $form = $this->createForm(NewslettreType::class, $newslettre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newslettre);
            $entityManager->flush();

            return $this->redirectToRoute('newslettre_index');
        }

        return $this->render('newslettre/new.html.twig', [
            'newslettre' => $newslettre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="newslettre_show", methods={"GET"})
     */
    public function show(Newslettre $newslettre): Response
    {
        return $this->render('newslettre/show.html.twig', [
            'newslettre' => $newslettre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="newslettre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Newslettre $newslettre): Response
    {
        $form = $this->createForm(NewslettreType::class, $newslettre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('newslettre_index', [
                'id' => $newslettre->getId(),
            ]);
        }

        return $this->render('newslettre/edit.html.twig', [
            'newslettre' => $newslettre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="newslettre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Newslettre $newslettre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newslettre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newslettre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('newslettre_index');
    }
}
