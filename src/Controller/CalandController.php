<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CalandController extends AbstractController
{
    /**
     * @Route("/caland", name="caland")
     */
    public function index()
    {
        return $this->render('caland/index.html.twig', [
            'controller_name' => 'CalandController',
        ]);
    }
}
