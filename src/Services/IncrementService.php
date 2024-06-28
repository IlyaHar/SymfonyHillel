<?php

namespace App\Services;

use App\Entity\Interfaces\IIncrement;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

class IncrementService
{
    public function __construct(
        protected EntityManagerInterface $em
    ) {}

    public function incrementAndSave(IIncrement $object): void
    {
        $object->increment();
        try {
            $this->em->persist($object);
            $this->em->flush();
        } catch (Throwable) {

        }
    }
}