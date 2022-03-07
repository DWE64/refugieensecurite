<?php
namespace App\Services;


use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Mailer\Exception\ExceptionInterface;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;


class MailerManage
{
    private $mailer;
    
    public function __construct(MailerInterface $mailer){
        $this->mailer=$mailer;
    }
    
    public function sendErrorUploadFileMessage(FileException $e){
        try{
            
            $mail=(new TemplatedEmail())
            ->from('error.file@refugieensecurite.com')
            ->to('contact@dwe64.com')
            ->priority(Email::PRIORITY_HIGH)
            ->subject("Erreur lors du chargement d'une image")
            ->htmlTemplate('admin/mailError/_mailFileError.html.twig')
            ->context([
                'preview' => $e->getPrevious(),
                'trace'=>$e->getTraceAsString(),
                'codeStatus'=>$e->getCode(),
                'line'=>$e->getLine(),
                'messageContent'=>$e->getMessage(),
                'file'=>$e->getFile(),
            ]);
            $this->mailer->send($mail);
            return null;
        }catch(TransportException $e){
            print_r($e);
            return null;
        }
    }
    
}

