<?php

namespace App\MyShortener\Exceptions;

use Exception;

class DataNotFoundException extends Exception
{
    protected $message = 'Data not found';
}