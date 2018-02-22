<?php

namespace Training\Test\Controller\Adminhtml\Action;

class Index extends \Magento\Backend\App\Action
{
    public function __construct(

        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->backendUrl = $context->getBackendUrl();
        parent::__construct($context);
    }

    /**
     * Test action index
     */
    public function execute()
    {
        $baseUrl = $this->backendUrl->getBaseUrl();
        $this->_redirect($baseUrl.'catalog/category/view/id/4');
        $this->getResponse()->appendBody("HELLO WORLD");
    }

    /**
     * Check if admin has permissions to visit related pages
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        $secret = $this->getRequest()->getParam('secret');
        return isset($secret) && (int)$secret == 1;
    }
}