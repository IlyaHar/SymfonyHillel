<?php

namespace App\Services;

use App\Entity\Shortener;
use App\MyShortener\Exceptions\DataNotFoundException;
use App\MyShortener\Interfaces\IUrlRepository;
use App\Repository\ShortenerRepository;
use App\Services\Factories\ShortenerFactory;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\Throw_;

class ShortenerDoctrineRepository implements IUrlRepository
{
    protected ShortenerRepository $repository;
    public function __construct(
        protected EntityManagerInterface $em,
        protected ShortenerFactory $factory
    )
    {
        $this->repository = $this->em->getRepository(Shortener::class);
    }

    public function saveEntity(string $code, string $url): bool
    {
        try {
            $this->factory->save($url, $code);
            $result = true;
        } catch (\Throwable) {
            $result = false;
        }
        return $result;
    }

    public function codeIsset(string $code): bool
    {
        return (bool) $this->repository->findOneBy(['code' => $code]);
    }

    public function getUrlByCode(string $code): string
    {
        return $this->getData(['code' => $code])->getUrl();
    }

    public function getCodeByUrl(string $url): string
    {
        return $this->getData(['url' => $url])->getCode();
    }

    protected function getData(array $fields): Shortener
    {
        if (is_null($entity = $this->repository->findOneBy($fields))) {
            throw new DataNotFoundException();
        }
        return $entity;
    }
}