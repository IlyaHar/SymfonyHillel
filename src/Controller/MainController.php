<?php

namespace App\Controller;

use PHPUnit\Framework\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main.index')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'sayHello' => 'Hello World!',
        ]);
    }

    #[Route('/{word}', name: 'main.word')]
    public function toUpperCase(string $word): Response
    {
        return $this->render('main/word.html.twig', [
           'word' => mb_strtoupper($word)
        ]);
    }

    #[Route('/calculate/{num1}/{action}/{num2}', name: 'main.calculate', requirements: ['num1' => '\d+', 'num2' => '\d+'])]
    public function calculate(int $num1, string $action, int $num2): Response
    {
        $result = match ($action) {
            '+' => $num1 + $num2,
            '-' => $num1 - $num2,
            ':' => $num1 / $num2,
            '*' => $num1 * $num2,
            default => throw new \InvalidArgumentException('Invalid action parameter')
        };

        return $this->render('main/calculate.html.twig', [
            'result' => $result
        ]);
    }
}
