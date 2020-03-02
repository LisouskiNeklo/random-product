<?php

namespace Neklo\RandomProduct\Api;

use Neklo\RandomProduct\Api\Data\RandomProductInterface;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Interface RandomProductRepositoryInterface
 */
interface RandomProductRepositoryInterface
{
    /**
     * @param RandomProductInterface $slider
     * @return RandomProductInterface
     * @throws CouldNotSaveException
     */
    public function save(RandomProductInterface $slider);
}
