<?php

namespace App\Factory;

use App\Entity\Product;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Product>
 */
final class ProductFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Product::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'createAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'description' => self::faker()->text(255),
            'image' => $this->generateImageUrl(),
            'name' => self::faker()->text(50),
            'price' => self::faker()->numberBetween(12,150),
            'slug' => self::faker()->slug(),
            'stock' => self::faker()->randomNumber(),
            'updateAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'category' => CategoryFactory::new(),
        ];
    }

    private function generateImageUrl(): string
    {
        // Option 1: Utiliser des images locales
        // $localImages = ['product1.jpg', 'product2.jpg', 'product3.jpg'];
        // return '/images/products/' . self::faker()->randomElement($localImages);

        // Option 2: Utiliser Picsum
        return 'https://picsum.photos/800/600?random=' . self::faker()->numberBetween(1, 1000);

        // Option 3: Utiliser Placeholder.com
        // $color = substr(md5(rand()), 0, 6); // Génère une couleur aléatoire
        // return "https://via.placeholder.com/800x600/{$color}/FFFFFF?text=Product+Image";
    }

    protected function initialize(): static
    {
        return $this;
    }
}