<?php

namespace App\Controller;

use App\Entity\Shortener;
use App\MyShortener\Interfaces\IUrlEncoder;
use App\Services\IncrementService;
use App\Services\ShortenerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/shortener', name: 'shortener_')]
class ShortenerController extends AbstractController
{
    #[Route('/encode', name: 'encode', methods: ['POST'])]
    public function encode(Request $request, IUrlEncoder $encoder): Response
    {
        $url = $request->get('url');
        $code = $encoder->encode($url);
        return $this->redirectToRoute('shortener_code_stats', ['code' => $code]);
    }

    #[Route('/{code}/stats', name: 'code_stats', requirements: ['code'=>'\w{6,8}'])]
    public function decode(Shortener $shortener): Response
    {
        return $this->render('shortener/url_code.html.twig', [
            'shortener' =>  $shortener,
        ]);
    }

    #[Route('/statistics', name: 'codes_stats')]
    public function allStats(ShortenerService $service): Response
    {
        return $this->render('shortener/url_codes.html.twig', [
            'url_codes' =>  $service->getAllByUser(),
        ]);
    }

    #[Route('/{code}', name: 'redirect', requirements: ['code'=>'\w{6,8}'])]
    public function redirectUrl(Shortener $shortener, IncrementService $incrementorService): Response
    {
        $incrementorService->incrementAndSave($shortener);
        return $this->redirect($shortener->getUrl());
    }
}