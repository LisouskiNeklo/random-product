<?php

namespace Neklo\RandomProduct\Api\Data;

/**
 * Interface RandomProductInterface
 */
interface RandomProductInterface
{
    const TABLE_NAME = 'neklo_random_product';

    /**#@+
     * Constants for keys of data array.
     */
     const ENTITY_ID = 'entity_id';
     const PRODUCT_ID = 'product_id';
    /**#@-*/

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $entityId
     *
     * @return $this
     */
    public function setId($entityId);

    /**
     * @return int
     */
    public function getProductId();

    /**
     * @param int $productId
     *
     * @return $this
     */
    public function setProductId($productId);
}
