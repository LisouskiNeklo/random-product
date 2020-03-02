<?php

namespace Neklo\RandomProduct\Model\ResourceModel;

use Neklo\RandomProduct\Api\Data\RandomProductInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class RandomProduct
 */
class RandomProduct extends AbstractDb
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(RandomProductInterface::TABLE_NAME, RandomProductInterface::ENTITY_ID);
    }
}
