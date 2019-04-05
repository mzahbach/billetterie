<?php

namespace App\Controller;

use App\Entity\CategoryPrice;
use App\Form\CategoryPriceType;
use App\Repository\CategoryPriceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categoryPrice")
 */
class CategoryPriceController extends AbstractController
{
    /**
     * @Route("/", name="category_price_index", methods={"GET"})
     */
    public function index(CategoryPriceRepository $categoryPriceRepository): Response
    {
        return $this->render('category_price/index.html.twig', [
            'category_prices' => $categoryPriceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="category_price_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoryPrice = new CategoryPrice();
        $form = $this->createForm(CategoryPriceType::class, $categoryPrice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoryPrice);
            $entityManager->flush();

            return $this->redirectToRoute('category_price_index');
        }

        return $this->render('category_price/new.html.twig', [
            'category_price' => $categoryPrice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_price_show", methods={"GET"})
     */
    public function show(CategoryPrice $categoryPrice): Response
    {
        return $this->render('category_price/show.html.twig', [
            'category_price' => $categoryPrice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category_price_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategoryPrice $categoryPrice): Response
    {
        $form = $this->createForm(CategoryPriceType::class, $categoryPrice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_price_index', [
                'id' => $categoryPrice->getId(),
            ]);
        }

        return $this->render('category_price/edit.html.twig', [
            'category_price' => $categoryPrice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_price_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CategoryPrice $categoryPrice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoryPrice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoryPrice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_price_index');
    }
}
