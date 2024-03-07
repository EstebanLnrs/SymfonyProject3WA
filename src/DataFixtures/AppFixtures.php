<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    

    public function load(ObjectManager $manager): void
    {
        $faker = \Fake\Factory::create('fr_FR');
        $fighter = [];
        $organisation = [];
        $categories = [];

        for ($i = 0; $i < 30; $i++) {
            $organisation = new Organisation();
            $organisation->setName($faker->word);
            $organisation[] = $organisation;
            $manager->persist($organisation);
        }

        for ($i = 0; $i < 30; $i++) {
            $categories = new Categories();
            $categories->setName($faker->word);
            $categories[] = $categories;
            $manager->persist($organisation);
        }

        for ($i = 0; $i < 30; $i++) {
            $categories = new Categories();
            $categories->setName($faker->word);
            $categories[] = $categories;
            $manager->persist($organisation);
        }

    }
}