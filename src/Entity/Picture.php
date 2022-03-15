<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $userSafe;

    #[ORM\Column(type: 'string', length: 255)]
    private $homeLocalisation;

    #[ORM\Column(type: 'string', length: 255)]
    private $homeCountry;

    #[ORM\Column(type: 'string', length: 255)]
    private $cityBecoming;

    #[ORM\Column(type: 'string', length: 255)]
    private $urlPicture;

    #[ORM\Column(type: 'boolean')]
    private $accepted;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateAccepted;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateRefused;

    public function __construct()
    {
        $this->accepted = false;
        $this->createdAt = new \DateTime("now");
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserSafe(): ?string
    {
        return $this->userSafe;
    }

    public function setUserSafe(string $userSafe): self
    {
        $this->userSafe = $userSafe;

        return $this;
    }

    public function getHomeLocalisation(): ?string
    {
        return $this->homeLocalisation;
    }

    public function setHomeLocalisation(string $homeLocalisation): self
    {
        $this->homeLocalisation = $homeLocalisation;

        return $this;
    }

    public function getHomeCountry(): ?string
    {
        return $this->homeCountry;
    }

    public function setHomeCountry(string $homeCountry): self
    {
        $this->homeCountry = $homeCountry;

        return $this;
    }

    public function getCityBecoming(): ?string
    {
        return $this->cityBecoming;
    }

    public function setCityBecoming(string $cityBecoming): self
    {
        $this->cityBecoming = $cityBecoming;

        return $this;
    }

    public function getUrlPicture(): ?string
    {
        return $this->urlPicture;
    }

    public function setUrlPicture(string $urlPicture): self
    {
        $this->urlPicture = $urlPicture;

        return $this;
    }

    public function getAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDateAccepted(): ?\DateTimeInterface
    {
        return $this->dateAccepted;
    }

    public function setDateAccepted(?\DateTimeInterface $dateAccepted): self
    {
        $this->dateAccepted = $dateAccepted;

        return $this;
    }

    public function getDateRefused(): ?\DateTimeInterface
    {
        return $this->dateRefused;
    }

    public function setDateRefused(?\DateTimeInterface $dateRefused): self
    {
        $this->dateRefused = $dateRefused;

        return $this;
    }
}
