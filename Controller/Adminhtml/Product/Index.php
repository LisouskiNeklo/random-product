<?php

namespace Neklo\RandomProduct\Controller\Adminhtml\Product;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

/**
 * Class Index
 */
class Index extends Action
{
    const ADMIN_RESOURCE = 'Neklo_RandomProduct::product';

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $page->getConfig()->getTitle()->set(__('Products'));
        $page->setActiveMenu('Magento_Backend::content');

        return $page;
    }
}
