<?php

namespace App\MyShortener\Validators;

use App\MyShortener\Interfaces\IUrlValidator;
use InvalidArgumentException;

class UrlValidator implements IUrlValidator
{

    public function validateUrl(string $url): true
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('URL is not valid');
        }
        return true;
    }

    public function checkRealUrl(string $url): true
    {
        if (!get_headers($url)) {
            throw new InvalidArgumentException('URL is not exists');
        }
        return true;
    }
}