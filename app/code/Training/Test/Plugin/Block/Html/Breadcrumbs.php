<?php
namespace Training\Test\Plugin\Block\Html;

class Breadcrumbs
{
    public function beforeAddCrumb(\Magento\Theme\Block\Html\Breadcrumbs $subject, $crumbName, $crumbInfo)
    {
        return [$crumbName."(!)", $crumbInfo];
    }
}