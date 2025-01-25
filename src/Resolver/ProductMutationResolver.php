<?php

namespace App\GraphQL\Resolver;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductMutationResolver
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createProduct(array $args): Product
    {
        $product = new Product();
        $product->setName($args['name']);
        $product->setPrice($args['price']);

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $product;
    }
}
