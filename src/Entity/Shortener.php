<?php

namespace App\Entity;

use App\Repository\ShortenerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
#[ORM\Entity(repositoryClass: ShortenerRepository::class)]
#[ORM\Table(name: 'shortener')]
class Shortener
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function __construct(
        #[ORM\Column(length: 255)]
        private string $url,

        #[ORM\Column(length: 8)]
        private string $code
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
