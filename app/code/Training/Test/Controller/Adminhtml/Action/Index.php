<?php

namespace Training\Test\Controller\Adminhtml\Action;

class Index extends \Magento\Backend\App\Action
{
    /**
     * Test action index
     */
    public function execute()
    {
        var_dump('here');die;
        $this->getResponse()->appendBody("HELLO WORLD");
    }

    /**
     * Check if admin has permissions to visit related pages
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return true;
        $secret = $this->getRequest()->getParam('secret');
        return isset($secret) && (int)$secret == 1;
    }
}