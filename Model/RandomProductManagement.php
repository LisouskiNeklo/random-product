<?php

namespace Neklo\RandomProduct\Model;

use Magento\Framework\MessageQueue\PublisherInterface;
use Neklo\RandomProduct\Api\RandomProductManagementInterface;
use Psr\Log\LoggerInterface;

/**
 * Class RandomProductManagement
 */
class RandomProductManagement implements RandomProductManagementInterface
{
    /**
     * @var PublisherInterface
     */
    protected $publisher;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param PublisherInterface $publisher
     * @param LoggerInterface $logger
     */
    public function __construct(
        PublisherInterface $publisher,
        LoggerInterface $logger
    ) {
        $this->publisher = $publisher;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function create()
    {
        try {
            $this->publisher->publish(Config::RANDOM_PRODUCT_QUEUE, '');
        } catch (\Exception $e) {
            $this->logger->critical($e);
        }
    }
}
