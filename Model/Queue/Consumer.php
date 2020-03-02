<?php

namespace Neklo\RandomProduct\Model\Queue;

use Magento\Catalog\Api\Data\ProductInterfaceFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product\Type;
use Magento\Framework\Math\Random;
use Neklo\RandomProduct\Api\Data\RandomProductInterfaceFactory;
use Neklo\RandomProduct\Api\RandomProductRepositoryInterface;
use Neklo\RandomProduct\Model\Config;
use Psr\Log\LoggerInterface;

/**
 * Class Consumer
 */
class Consumer
{
    /**
     * @var ProductInterfaceFactory
     */
    protected $productFactory;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var RandomProductInterfaceFactory
     */
    protected $randomProductFactory;

    /**
     * @var RandomProductRepositoryInterface
     */
    protected $randomProductRepository;

    /**
     * @var Random
     */
    protected $random;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param ProductInterfaceFactory $productFactory
     * @param ProductRepositoryInterface $productRepository
     * @param RandomProductInterfaceFactory $randomProductFactory
     * @param RandomProductRepositoryInterface $randomProductRepository
     * @param Random $random
     * @param LoggerInterface $logger
     */
    public function __construct(
        ProductInterfaceFactory $productFactory,
        ProductRepositoryInterface $productRepository,
        RandomProductInterfaceFactory $randomProductFactory,
        RandomProductRepositoryInterface $randomProductRepository,
        Random $random,
        LoggerInterface $logger
    ) {
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
        $this->randomProductFactory = $randomProductFactory;
        $this->randomProductRepository = $randomProductRepository;
        $this->random = $random;
        $this->logger = $logger;
    }

    /**
     * @return void
     */
    public function process()
    {
        try {
            $product = $this->productFactory->create();
            $product->setName('Product' . $this->random->getRandomString(3));
            $product->setSku($this->random->getRandomString(6, 'abcdefghijklmnopqrstuvwxyz'));
            $product->setDescription($this->random->getRandomString(6));
            $product->setShortDescription($this->random->getRandomString(6));
            $product->setMetaTitle($this->random->getRandomString(6));
            $product->setMetaKeyword($this->random->getRandomString(6));
            $product->setMetaDescription($this->random->getRandomString(6));
            $product->setWeight((int)$this->random->getRandomString(2, '12346789'));
            $product->setStatus((int)$this->random->getRandomString(1, '0123'));
            $product->setTaxClassId((int)$this->random->getRandomString(1, '1234'));
            $product->setTypeId(Type::TYPE_SIMPLE);
            $product->setVisibility((int)$this->random->getRandomString(3, '1234'));
            $product->setPrice((int)$this->random->getRandomString(2, '12346789'));
            $product->setAttributeSetId(Config::ATTRIBUTE_SET_ID);
            $product->setWebsiteIds([Config::WEBSITE_ID]);
            $product->setStockData([
                'is_in_stock' => (int)$this->random->getRandomString(3, '12346789'),
                'qty' => (int)$this->random->getRandomString(3, '12346789'),
            ]);

            $savedProduct = $this->productRepository->save($product);

            $randomProduct = $this->randomProductFactory->create();
            $randomProduct->setProductId((int)$savedProduct->getId());

            $this->randomProductRepository->save($randomProduct);
        } catch (\Exception $e) {
            $this->logger->critical($e);
        }
    }
}
