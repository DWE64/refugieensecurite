<?php


namespace App\MessageHandler;

use App\Message\MailNewAsk;
use App\Repository\PictureRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;

#[AsMessageHandler]
class MailNewAskHandler
{
    private $mailer;
    private $pictureRep;

    public function __construct(
        MailerInterface $mailer,
        PictureRepository $pictureRep
    ){
        $this->mailer=$mailer;
        $this->pictureRep=$pictureRep;
    }

    public function __invoke(MailNewAsk $mail)
    {
        $picture = $this->pictureRep->find($mail->getContent());
        try {
            $mail=(new TemplatedEmail())
                ->from('nouvelle_demande@refugieensecurite.com')
                ->to('contact@dwe64.com')
                ->priority(Email::PRIORITY_HIGH)
                ->subject("Demande de validation pour l'objet ".$picture->getId().' - '.$picture->getUserSafe())
                ->htmlTemplate('admin/mailAsking/_mailAsking.html.twig')
                ->context([
                    'idUserSafe' => $picture->getId()
                ]);
            $this->mailer->send($mail);
        }catch (TransportException $e){
            print_r($e);
            return null;
        }
    }
}