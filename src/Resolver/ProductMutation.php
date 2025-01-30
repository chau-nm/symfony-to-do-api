<?php

namespace App\Resolver;

use App\Entity\Product;
use App\Service\ProductService;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

/**
 * GraphQL Mutation Resolver
 */
class ProductMutation implements MutationInterface
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Add new product
     *
     * @param array $newProduct
     * @return Product
     * @throws Exception
     */
    public function add(array $newProduct): Product
    {
        return $this->productService->create($newProduct);
    }

    /**
     * Update Product
     *
     * @param int $productId
     * @param array $newProduct
     *
     * @return Product
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function update(int $productId, array $newProduct): Product
    {
        return $this->productService->update($productId, $newProduct);
    }

    /**
     * Delete product
     *
     * @param int $productId
     * @return bool
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function delete(int $productId): bool
    {
        return $this->productService->delete($productId);
    }
}