<?php


namespace App\Services;


use App\Message\MailError;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadFileService
{
    private $targetDirectory;
    private $slugger;
    private $bus;

    public function __construct(
        $targetDirectory,
        SluggerInterface $slugger,
        MessageBusInterface $mailerManage,
    )
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
        $this->bus = $mailerManage;
    }

    public function uploadFile(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            $responseMailer = $this->bus->dispatch(new MailError($e));
            return $responseMailer;
        }

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}