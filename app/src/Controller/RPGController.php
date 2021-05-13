<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class RPGController extends AbstractController
{
    private object $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/rpg", name="rpg_index")
    */
    public function rpg(): Response
    {
        $this->session->clear();

        return $this->render('standard.html.twig', [
            'header' => "Welcome!",
            'message' => 'This is my page!'
        ]);
    }
}
