<?php
namespace Training\Orm\Setup;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Setup\CategorySetup;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var CategorySetupFactory
     */
    private $catalogSetupFactory;
    public function __construct(CategorySetupFactory $categorySetupFactory)
    {
        $this->catalogSetupFactory = $categorySetupFactory;
    }
    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $dbVersion = $context->getVersion();
        if (version_compare($dbVersion, '0.1.1', '<')) {
// ...
        }
        if (version_compare($dbVersion, '0.1.2', '<')) {
            /** @var CategorySetup $catalogSetup */
            $catalogSetup = $this->catalogSetupFactory->create(['setup' => $setup]);
            $catalogSetup->updateAttribute(
                Product::ENTITY,
                'example_multiselect',
                [
                    'frontend_model' =>
                        \Training\Orm\Entity\Attribute\Frontend\HtmlList::class,
                    'is_html_allowed_on_front' => 1,
                ]
            );
        }
    }
}