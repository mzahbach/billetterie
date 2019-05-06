<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NotifController extends AbstractController
{
    
    public function index()
    {
        $notification = $this->getDoctrine()->getManager()->getRepository( 'App:Notification')->findAll();
        return $this->render('@App/notification.html.twig',[
            'notif' => $notification
            ]);
    }
}
