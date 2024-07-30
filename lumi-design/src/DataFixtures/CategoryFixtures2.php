<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures2 extends Fixture
{
    private $faker;
 
    public function __construct()
    {
      
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $name = $this->faker->unique()->word();
            $category->setName($name);
            
            $manager->persist($category);
            
            $this->addReference('category_' . $i, $category);
        }

        $manager->flush();
    }
}