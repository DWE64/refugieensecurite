<?php
namespace App\Services;


use App\Entity\Picture;
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
    public function sendEmailNewFile(Picture $picture)
    {
        try {
            $mail=(new TemplatedEmail())
                ->from('nouvelle_demande@refugieensecurite.com')
                ->to('contact@dwe64.com')
                ->priority(Email::PRIORITY_HIGH)
                ->subject("Demande de validation pour l'objet ".$picture->getId().' - '.$picture->getUserSafe())
                ->htmlTemplate('admin/mailAsking/_mailAsking.html.twig')
                ->context([
                    'idUserSafe' => $picture->getId(),
                    'dateCreated'=>$picture->getCreatedAt()
                ]);
            $this->mailer->send($mail);
        }catch (TransportException $e){
            print_r($e);
            return null;
        }
    }
    
}

