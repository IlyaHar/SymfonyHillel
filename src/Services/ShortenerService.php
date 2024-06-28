<?php

namespace App\Services;

use App\Entity\Shortener;
use App\Repository\ShortenerRepository;
use Doctrine\ORM\EntityManagerInterface;

class ShortenerService
{
    protected ShortenerRepository $repository;

    public function __construct(
        protected EntityManagerInterface $em
    )
    {
        $this->repository = $this->em->getRepository(Shortener::class);
    }

    public function getAllByUser():array
    {
        return $this->repository->findAll();
    }
}