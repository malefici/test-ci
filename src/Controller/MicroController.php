<?php

namespace Malefici\TestCi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MicroController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(Request $request): Response
    {
        return $this->render('micro/index.html.twig', []);
    }

    #[Route('/random/{limit}', name: 'app_random')]
    public function randomNumber(int $limit): Response
    {
        $number = random_int(0, $limit);

        return $this->render('micro/random.html.twig', [
            'number' => $number,
        ]);
    }
}