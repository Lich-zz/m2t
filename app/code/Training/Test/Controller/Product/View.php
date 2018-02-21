<?php

namespace Training\Test\Controller\Product;
class View
{

    public function beforeExecute()
    {
       echo "BEFORE<BR>"; exit;
    }

    public function afterExecute(\Magento\Catalog\Controller\Product\View $controller, $result)
    {
        echo "AFTER";
        exit;
    }

}