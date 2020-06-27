<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Articles;
use Faker;
use Faker\Factory;
class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($count = 0; $count < 20; $count++) {
            $product = new Articles();
            $product->setName('Article'.$count)
                ->setPrice($faker->randomNumber(2))
                ->setQte($faker->numberBetween(0, 150))
                ->setCreatedAt($faker->dateTimeThisYear($max = 'now', $timezone = null))
                ->setDescription($faker->text());
            $manager->persist($product);
        }
        $manager->flush();
    }
}
