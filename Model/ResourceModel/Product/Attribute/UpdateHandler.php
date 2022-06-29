<?php
namespace MKD\MageplazaPreOrder\Model\ResourceModel\Product\Attribute;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use MKD\MageplazaPreOrder\Helper\Data;

/**
 * Class UpdateHandler
 * @package Mageplaza\PreOrder\Model\ResourceModel\Config\Product\Attribute
 */
class UpdateHandler extends \Mageplaza\PreOrder\Model\ResourceModel\Product\Attribute\UpdateHandler
{
    /**
     * @var AttributeRepository
     */
    private $attributeRepository;

    protected function getAttributes($entityType, $attributeSetId = null)
    {
        return [
            $this->attributeRepository->get(ProductAttributeInterface::ENTITY_TYPE_CODE, Data::DELIVERY_TIME_ATTR)
        ];
    }
}
