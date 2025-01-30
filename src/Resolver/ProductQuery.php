<?php

namespace App\Resolver;

use App\Entity\Product;
use App\Service\ProductService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

/**
 * GraphQL Query Resolver
 */
class ProductQuery implements QueryInterface
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Get all product
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->productService->getAll();
    }

    /**
     * Get product by ID
     *
     * @param int $id
     * @return Product
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function getById(int $id): Product
    {
        return $this->productService->getById($id);
    }
}