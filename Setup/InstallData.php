<?php
namespace MKD\MageplazaPreOrder\Setup;

use Magento\Catalog\Model\Product;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use MKD\MageplazaPreOrder\Helper\Data;

/**
 * Class InstallData
 * @package Mageplaza\PreOrder\Setup
 */
class InstallData extends \Mageplaza\PreOrder\Setup\InstallData
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(Product::ENTITY, Data::DELIVERY_TIME_ATTR, array_merge($this->getDefaultOptions(), [
            'label' => __('Delivery Time'),
            'type' => 'varchar',
            'input' => 'text',
            'backend' => NULL,
            'frontend' => NULL
        ]));
    }
}
