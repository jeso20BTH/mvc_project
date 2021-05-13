<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class IndexController extends AbstractController
{
    private object $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="index")
    */
    public function greeting(): Response
    {
        $this->session->clear();

        return $this->render('base.html.twig', [
            'header' => "Welcome!",
            'message' => <<<EOD
                            Welcome to my RPG dice style game. You will face enemies with dices as your weapon!
                            Are you up to the challange?!
                        EOD
        ]);
    }
}
