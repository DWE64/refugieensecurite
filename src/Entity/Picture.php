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
}
