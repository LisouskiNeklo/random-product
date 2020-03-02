<?php

namespace Neklo\RandomProduct\Model\ResourceModel\Slider;

use Neklo\RandomProduct\Model\ResourceModel\RandomProduct as Resource;
use Neklo\RandomProduct\Model\RandomProduct as Model;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected $_eventObject = 'random_product_collection';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(Model::class, Resource::class);
        $this->_setIdFieldName($this->getResource()->getIdFieldName());
    }
}
