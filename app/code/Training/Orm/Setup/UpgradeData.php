<?php
namespace Training\Orm\Setup;
use Magento\Catalog\Model\Product;
use Magento\Customer\Model\Customer;
use Magento\Catalog\Setup\CategorySetup;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var CategorySetupFactory
     */
    private $catalogSetupFactory;
    public function __construct(CategorySetupFactory $categorySetupFactory,CustomerSetupFactory $customerSetupFactory)
    {
        $this->catalogSetupFactory = $categorySetupFactory;
        $this->customerSetupFactory = $customerSetupFactory;
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
        if (version_compare($dbVersion, '0.1.3', '<')) {
            /** @var CustomerSetup $customerSetup */
            $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
            $customerSetup->addAttribute(
                Customer::ENTITY,
                'priority',
                [
                    'label' => 'Priority',
                    'type' => 'int',
                    'input' => 'select',
                    'source' => \Training\Orm\Entity\Attribute\Source\CustomerPriority::class,
                    'required' => 0,
                    'system' => 0,
                    'position' => 100
                ]);
            $customerSetup->getEavConfig()->getAttribute('customer', 'priority')
                ->setData('used_in_forms', ['adminhtml_customer'])
                ->save();
        }
    }
}