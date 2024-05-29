<?php

namespace App\MyShortener\Interfaces;

use App\MyShortener\Exceptions\DataNotFoundException;

interface IUrlRepository
{
    public function saveEntity(string $code, string $url): bool;

    /**
     * @param string $code
     * @return bool
     */
    public function codeIsset(string $code): bool;

    /**
     * @param string $code
     * @throws DataNotFoundException
     * @return string url
     */
    public function getUrlByCode(string $code): string;

    /**
     * @param string $url
     * @throws DataNotFoundException
     * @return string code
     */
    public function getCodeByUrl(string $url): string;
}