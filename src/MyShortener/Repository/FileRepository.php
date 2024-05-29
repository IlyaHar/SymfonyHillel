<?php

namespace App\MyShortener\Repository;

use App\MyShortener\Exceptions\DataNotFoundException;
use App\MyShortener\Interfaces\IUrlRepository;

class FileRepository implements IUrlRepository
{
    protected array $storage = [];

    public function __construct(protected string $file) {
        $this->save();
    }

    public function save(): void
    {
        if (file_exists($this->file)) {
            $content = file_get_contents($this->file);
            $this->storage = json_decode($content, true);
        }
    }

    public function saveEntity(string $code, string $url): bool
    {
        $this->storage[$code] = $url;
        return true;
    }

    public function codeIsset(string $code): bool
    {
        return isset($this->storage[$code]);
    }

    public function getUrlByCode(string $code): string
    {
        if (!$this->codeIsset($code)) {
            throw new DataNotFoundException();
        }
        return $this->storage[$code];
    }

    public function getCodeByUrl(string $url): string
    {
        if (!$code = array_search($url, $this->storage)) {
            throw new DataNotFoundException();
        }
        return $code;
    }

    public function writeAndSaveCode(string $content): void
    {
        $file = fopen($this->file, 'w+');
        fwrite($file, $content);
        fclose($file);
    }

    public function __destruct()
    {
        $this->writeAndSaveCode(json_encode($this->storage, JSON_PRETTY_PRINT));
    }
}