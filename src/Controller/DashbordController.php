<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EvenementRepository;
use App\Repository\CategoryPriceRepository;
use App\Repository\CommentRepository;
use App\Repository\FactureRepository;
use App\Entity\User;

class DashbordController extends AbstractController
{
    /**
     * @Route("/dashbord", name="dashbord")
     */
    public function index(EvenementRepository $eventRepo,CategoryPriceRepository $catRepo , CommentRepository $commentRepo ,FactureRepository $factRepo)
    {
        $nbrevent= count($eventRepo->findAll());
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
            'nbrComment' => $nbrComment
        ]);
    }
}
