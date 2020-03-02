<?php

namespace Neklo\RandomProduct\Model;

use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Neklo\RandomProduct\Api\RandomProductRepositoryInterface;
use Neklo\RandomProduct\Api\Data\RandomProductInterface;
use Neklo\RandomProduct\Model\ResourceModel\RandomProduct as Resource;

/**
 * Class RandomProductRepository
 */
class RandomProductRepository implements RandomProductRepositoryInterface
{
    /**
     * @var Resource
     */
    private $resource;

    /**
     * @param Resource $resource
     */
    public function __construct(
        Resource $resource
    ) {
        $this->resource = $resource;
    }

    /**
     * @inheritdoc
     */
    public function save(RandomProductInterface $randomProduct)
    {
        try {
            $this->resource->save($randomProduct);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $randomProduct;
    }
}
