<?php
namespace Training\Test\Plugin\Block\Html;

class Footer
{
    public function aroundGetCopyright(\Magento\Theme\Block\Html\Footer $subject, callable $proceed)
    {
        return "“Customized copyright!”";
    }
}