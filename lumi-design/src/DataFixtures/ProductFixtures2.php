<?php

namespace App\DataFixtures;

use App\Entity\Product;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductFixtures2 extends Fixture implements DependentFixtureInterface
{
    private $faker;
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
        $this->faker = Factory::create();
        $this->faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($this->faker));
    }


    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i++) {
            $product = new Product();
            $name = $this->faker->unique()->word();
            $product->setName($name)
                ->setSlug($this->slugger->slug($name)->lower())
                ->setDescription($this->faker->realText(200, 2))
                ->setImage($this->faker->imageUrl(width: 800, height: 600))
                ->setPrice($this->faker->randomFloat(2, 1, 100))
                ->setStock($this->faker->numberBetween(0, 100))
                ->setCreateAt(new DateTimeImmutable($this->faker->date()))
                ->setUpdateAt(new DateTimeImmutable($this->faker->date()))
                ->setCategory($this->getReference('category_' . $this->faker->numberBetween(0, 4)));

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures2::class];
    }
}