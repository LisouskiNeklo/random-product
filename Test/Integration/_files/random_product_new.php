<?php

use Neklo\RandomProduct\Api\RandomProductRepositoryInterface;
use Neklo\RandomProduct\Model\RandomProduct;

$objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();

/** @var RandomProduct $randomProduct */
$randomProduct = $objectManager->create(RandomProduct::class);
$randomProduct->setId(99);
$randomProduct->setProductId(199);

/** @var RandomProductRepositoryInterface $orderRepository */
$randomProductRepository = $objectManager->create(RandomProductRepositoryInterface::class);
$randomProductRepository->save($randomProduct);
