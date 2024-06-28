<?php

namespace App\Controller;

use App\Entity\Shortener;
use PHPUnit\Framework\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main.index')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }
}
