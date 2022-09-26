<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    #[Route("/lucky/number", name:"app_lucky_number")]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }

    #[Route("/color/{couleur}", name:"app_color")]
    public function color(string $couleur)
    {
        return $this->render('lucky/color.html.twig', [
            'color' => $couleur,
        ]);
    }

    #[Route("/request", name:"app_request")]
    public function requestNav(Request $request)
    {
        return $this->render('lucky/request.html.twig', [
            'request' => $request,
        ]);
    }
}
