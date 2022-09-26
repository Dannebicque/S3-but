<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TimeController extends AbstractController
{
    #[Route('/time/now', name: 'app_time')]
    public function index(): Response
    {
        $date = new \DateTime('now');
        return $this->render('time/index.html.twig', [
            'madate' => $date->format('H:i:s'),
        ]);
    }
}
