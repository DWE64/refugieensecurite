<?php


namespace App\Message;


use App\Entity\Picture;

class MailNewAsk
{
    private $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}