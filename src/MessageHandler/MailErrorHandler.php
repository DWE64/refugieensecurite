<?php


namespace App\MessageHandler;

use App\Message\MailError;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;

#[AsMessageHandler]
class MailErrorHandler
{
    private $mailer;

    public function __construct(MailerInterface $mailer){
        $this->mailer=$mailer;
    }

    public function __invoke(MailError $mail)
    {
        $e = $mail->getContent();
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