<?php

namespace Neklo\RandomProduct\Test\Unit\Model;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\Data\ProductInterfaceFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Math\Random;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;
use Neklo\RandomProduct\Api\Data\RandomProductInterface;
use Neklo\RandomProduct\Api\Data\RandomProductInterfaceFactory;
use Neklo\RandomProduct\Api\RandomProductRepositoryInterface;
use Neklo\RandomProduct\Model\Queue\Consumer;
use Psr\Log\LoggerInterface;

/**
 * Class ConsumerTest
 */
class ConsumerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $productFactory;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $product;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $productRepository;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $randomProductFactory;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $randomProduct;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $randomProductRepository;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $random;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $logger;

    /**
     * @var Consumer
     */
    private $consumer;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        $objectManager = new ObjectManagerHelper($this);

        $this->productFactory = $this->getMockBuilder(ProductInterfaceFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMockForAbstractClass();

        $this->productRepository = $this->createMock(ProductRepositoryInterface::class);

        $this->randomProductFactory = $this->getMockBuilder(RandomProductInterfaceFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();
        $this->randomProductRepository = $this->createMock(RandomProductRepositoryInterface::class);

        $this->random = $this->createMock(Random::class);
        $this->logger = $this->createMock(LoggerInterface::class);

        $this->consumer = $objectManager->getObject(
            Consumer::class,
            [
                'productFactory' => $this->productFactory,
                'productRepository' => $this->productRepository,
                'randomProductFactory' => $this->randomProductFactory,
                'randomProductRepository' => $this->randomProductRepository,
                'random' => $this->random,
                'logger' => $this->logger
            ]
        );
    }

    /**
     * Queue consumer test
     */
    public function testProcess()
    {
        $product = $this->getMockBuilder(ProductInterface::class)
            ->setMethods(
                [
                    'setDescription',
                    'setShortDescription',
                    'setMetaTitle',
                    'setMetaKeyword',
                    'setMetaDescription',
                    'setTaxClassId',
                    'setWebsiteIds',
                    'setStockData'
                ]
            )
            ->getMockForAbstractClass();

        $randomProduct = $this->getMockBuilder(RandomProductInterface::class)
            ->setMethods(
            [
                'setProductId'
            ]
        )
            ->getMockForAbstractClass();

        $this->productFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($product);

        $this->productRepository
            ->expects($this->once())
            ->method('save')
            ->with($product)
            ->willReturn($product);

        $this->randomProductFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($randomProduct);

        $this->randomProductRepository->expects($this->once())
            ->method('save')
            ->with($randomProduct)
            ->willReturn($randomProduct);

        $this->assertNull($this->consumer->process());
    }
}
