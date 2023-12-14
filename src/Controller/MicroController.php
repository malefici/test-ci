<?php

namespace Malefici\TestCi\Controller;

use Malefici\TestCi\Repository\NewsletterRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class MicroController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(Request $request, NewsletterRepository $newsletterRepository): Response
    {
        return $this->render('micro/index.html.twig', [
            'news' => $newsletterRepository->findAll(),
        ]);
    }

    #[Route('/random/{limit}', name: 'app_random')]
    public function randomNumber(int $limit): Response
    {
        $number = random_int(0, $limit);

        return $this->render('micro/random.html.twig', [
            'number' => $number,
        ]);
    }

    #[Route('/newsletter/{id}', name: 'app_newsletter_view')]
    public function newsletter(int $id, LoggerInterface $logger, NewsletterRepository $newsletterRepository): Response
    {
//        $logger->critical('ads');

        $newsletter = $newsletterRepository->find($id);
        if (null === $newsletter) {
            throw new NotFoundHttpException();
        }

        return $this->render('micro/newsletter.html.twig', [
            'newsletter' => $newsletterRepository->find($id),
        ]);
    }
}