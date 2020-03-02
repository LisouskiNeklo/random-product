<?php

namespace Neklo\RandomProduct\Api;

/**
 * Interface RandomProductManagementInterface
 * @api
 */
interface RandomProductManagementInterface
{
    /**
     * Create random product via message queue
     *
     * @return void
     */
    public function create();
}
