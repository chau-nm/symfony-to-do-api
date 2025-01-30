<?php

namespace App\Service;

use App\Entity\Product;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

class ProductService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get all products
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->entityManager->getRepository(Product::class)->findAll();
    }

    /**
     * Get product by id
     *
     * @param int $id
     *
     * @return Product
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function getById(int $id): Product
    {
        return $this->entityManager->find(Product::class, $id);
    }

    /**
     * Create product
     *
     * @param array $newProduct
     * @return Product|null
     * @throws Exception
     */
    public function create(array $newProduct): Product|null
    {
        try {
            $this->entityManager->getConnection()->beginTransaction();
            $product = new Product();
            $product->setName($newProduct['name']);
            $product->setPrice($newProduct['price']);

            $this->entityManager->persist($product);
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
            return $product;
        } catch (Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            return null;
        }
    }

    /**
     * Update product
     *
     * @param int $id
     * @param array $newProduct
     * @return Product
     * @throws Exception
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(int $id, array $newProduct): Product
    {
        try {
            $this->entityManager->getConnection()->beginTransaction();
            $product = $this->entityManager->find(Product::class, $id);
            $product->setName($newProduct['name']);
            $product->setPrice($newProduct['price']);

            $this->entityManager->persist($product);
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
            return $product;
        } catch (Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            throw $e;
        }
    }

    /**
     * Delete product
     *
     * @param int $id
     * @return bool
     * @throws Exception
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(int $id): bool
    {
        try {
            $this->entityManager->getConnection()->beginTransaction();
            $this->entityManager->remove($this->entityManager->find(Product::class, $id));
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            return false;
        }
    }
}