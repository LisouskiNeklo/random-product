<?php

namespace Neklo\RandomProduct\Test\Unit\Model;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;
use Neklo\RandomProduct\Model\Config;

/**
 * Class RandomProductManagementTest
 */
class RandomProductManagementTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $publisher;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $logger;

    /**
     * @var \Neklo\RandomProduct\Model\RandomProductManagement
     */
    private $randomProductManagement;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        $objectManager = new ObjectManagerHelper($this);

        $this->publisher = $this->createMock(\Magento\Framework\MessageQueue\PublisherInterface::class);
        $this->logger = $this->createMock(\Psr\Log\LoggerInterface::class);

        $this->randomProductManagement = $objectManager->getObject(
            \Neklo\RandomProduct\Model\RandomProductManagement::class,
            [
                'publisher' => $this->publisher,
                'logger' => $this->logger
            ]
        );
    }

    /**
     * Create publisher test
     */
    public function testCreate()
    {
        $this->publisher->expects($this->once())
            ->method('publish')
            ->with(Config::RANDOM_PRODUCT_QUEUE, '');

        $this->assertNull($this->randomProductManagement->create());
    }
}
