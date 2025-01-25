<?php

namespace App\Resolver;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductResolver
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke($id): ?Product
    {
        return $this->entityManager->getRepository(Product::class)->find($id);
    }

    public function getAllProducts(): array
    {
        return $this->entityManager->getRepository(Product::class)->findAll();
    }
}
