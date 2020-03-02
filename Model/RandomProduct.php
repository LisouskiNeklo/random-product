<?php

namespace Neklo\RandomProduct\Model;

use Neklo\RandomProduct\Api\Data\RandomProductInterface;
use Neklo\RandomProduct\Model\ResourceModel\RandomProduct as Resource;
use Magento\Framework\Model\AbstractModel;

/**
 * Class RandomProduct
 */
class RandomProduct extends AbstractModel implements RandomProductInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(Resource::class);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @inheritdoc
     */
    public function setId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @inheritDoc
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * @inheritDoc
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }
}
