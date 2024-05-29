<?php

namespace App\MyShortener;

use App\MyShortener\Exceptions\DataNotFoundException;
use App\MyShortener\Interfaces\IUrlDecoder;
use App\MyShortener\Interfaces\IUrlRepository;
use InvalidArgumentException;

class UrlDecoder implements IUrlDecoder
{

    public function __construct(protected IUrlRepository $repository) {}

    public function decode(string $code): string
    {
        try {
            $url = $this->repository->getUrlByCode($code);
        } catch (DataNotFoundException $e) {
            throw new InvalidArgumentException('Code not found');
        }

        return $url;
    }
}