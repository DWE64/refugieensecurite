<?php


namespace App\Services;


use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadFileService
{
    private $targetDirectory;
    private $slugger;
    private $mailer;

    public function __construct(
        $targetDirectory,
        SluggerInterface $slugger,
        MailerManage $mailerManage,
    )
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
        $this->mailer = $mailerManage;
    }

    public function uploadFile(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            $responseMailer = $this->mailer->sendErrorUploadFileMessage($e);
            return $responseMailer;
        }

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}