<?php

namespace App\Controller;

use App\MyShortener\Interfaces\IUrlDecoder;
use App\MyShortener\Interfaces\IUrlEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/shortener', name: 'shortener.')]
class ShortenerController extends AbstractController
{
    #[Route('/encode/{url}', name: 'encode', requirements: ['url' => '.*'])]
    public function encode(string $url, IUrlEncoder $encoder): Response
    {
        $code = $encoder->encode($url);

        return new Response($code);
    }

    #[Route('/decode/{code}', name: 'decode')]
    public function decode(string $code, IUrlDecoder $decoder): Response
    {
        $url = $decoder->decode($code);

        return new Response($url);
    }
}
