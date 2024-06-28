<?php

namespace App\Entity;

use App\Repository\ShortenerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
#[ORM\Entity(repositoryClass: ShortenerRepository::class)]
#[ORM\Table(name: 'shortener')]
class Shortener implements \App\Entity\Interfaces\IIncrement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $count = 0;

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function incrementCount(): static
    {
        $this->count++;
        return $this;
    }

    public function __construct(
        #[ORM\Column(length: 255)]
        private string $url,

        #[ORM\Column(length: 8)]
        private string $code,

        #[ORM\ManyToOne(targetEntity: User::class, fetch: 'LAZY')]
        #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
        private User $user
    )
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
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

    public function increment(): void
    {
        $this->incrementCount();
    }
}
