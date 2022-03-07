<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i<20; $i++){
            $userSafe = new Picture();
            $userSafe->setUserSafe($faker->firstName);
            $userSafe->setHomeLocalisation($faker->city);
            $userSafe->setHomeCountry($faker->country);
            $userSafe->setCityBecoming($faker->city);
            $userSafe->setUrlPicture('ptFormat3-62268c9d40b48.png');
            $manager->persist($userSafe);
        }

        $manager->flush();
    }
}
