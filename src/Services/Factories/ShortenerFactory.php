<?php

namespace App\Services\Factories;

use App\Entity\Shortener;
use App\Repository\ShortenerRepository;
use Doctrine\ORM\EntityManagerInterface;

class ShortenerFactory
{

    protected ShortenerRepository $repository;
    public function __construct(
        protected EntityManagerInterface $em
    )
    {
        $this->repository = $this->em->getRepository(Shortener::class);
    }

    public function save(string $url, string $code): Shortener
    {
        $entity = new Shortener($url, $code);
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
}