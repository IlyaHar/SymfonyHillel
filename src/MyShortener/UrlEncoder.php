<?php

namespace App\MyShortener;

use App\MyShortener\Exceptions\DataNotFoundException;
use App\MyShortener\Interfaces\IUrlEncoder;
use App\MyShortener\Interfaces\IUrlRepository;
use App\MyShortener\Interfaces\IUrlValidator;

class UrlEncoder implements IUrlEncoder
{
    const CODE_LENGTH = 8;
    const SYMBOLS = 'apskfpofkapfgpoigjm';
    public function __construct(
        protected IUrlValidator $validator,
        protected IUrlRepository $repository,
        protected $codeLength = self::CODE_LENGTH)
    {}

    public function encode(string $url): string
    {
        $this->validate($url);

        try {
            $code = $this->repository->getCodeByUrl($url);
        } catch (DataNotFoundException) {
            $code = $this->generateUniqueCode($url);
            $this->repository->saveEntity($code, $url);
        }
        return $code;
    }

    protected function validate(string $url): void
    {
        $this->validator->validateUrl($url);
        $this->validator->checkRealUrl($url);
    }

    protected function urlReplace(string $url): string
    {
        $url = str_replace('/', '', $url);
        $url = str_replace(':', '', $url);
        $url = str_replace('.', '', $url);
        return  $url;
    }
    protected function generateUniqueCode(string $url): string
    {
        $code = $this->urlReplace($url) .  self::SYMBOLS . mb_strtoupper(self::SYMBOLS) . rand();
        $code = substr(str_shuffle($code), 0, $this->codeLength);
        return $code;
    }
}