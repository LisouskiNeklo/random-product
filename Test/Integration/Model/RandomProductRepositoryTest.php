<?php

namespace Magento\CatalogInventory\Model\StockItemSave;

use Magento\TestFramework\Helper\Bootstrap;
use Neklo\RandomProduct\Api\Data\RandomProductInterface;
use Neklo\RandomProduct\Api\Data\RandomProductInterfaceFactory;
use Neklo\RandomProduct\Api\RandomProductRepositoryInterface;

class RandomProductRepositoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var RandomProductRepositoryInterface
     */
    private $randomProductRepository;

    /**
     * @var RandomProductInterfaceFactory
     */
    private $randomProductFactory;

    /**
     * @inheritDoc
     */
    public function setUp()
    {
        $objectManager = Bootstrap::getObjectManager();

        $this->randomProductRepository = $objectManager->create(
            RandomProductRepositoryInterface::class
        );
        $this->randomProductFactory = $objectManager->create(
            RandomProductInterfaceFactory::class
        );
    }

    /**
     * @magentoDbIsolation disabled
     */
    public function testSaveOnInsert()
    {
        /** @var RandomProductInterface $randomProductData */
        $randomProductData = $this->randomProductFactory->create()
            ->setId(99)
            ->setProductId(99);
        $randomProductData = $this->randomProductRepository->save($randomProductData);

        $this->assertEquals(99, $randomProductData->getId());
        $this->assertEquals(99, $randomProductData->getProductId());
    }
}
