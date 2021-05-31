<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @codeCoverageIgnore
 */
class MonsterDiceController extends AbstractController
{
    /**
     * @Route("/monster/dice", name="monster_dice")
     */
    public function index(): Response
    {
        return $this->render('monster_dice/index.html.twig', [
            'controller_name' => 'MonsterDiceController',
        ]);
    }
}
