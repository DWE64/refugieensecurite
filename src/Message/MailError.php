<?php


namespace App\Message;


use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MailError
{
    private FileException $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function getContent(): FileException
    {
        return $this->content;
    }
}