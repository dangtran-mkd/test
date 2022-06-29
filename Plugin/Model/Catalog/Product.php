<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_PreOrder
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace MKD\MageplazaPreOrder\Plugin\Model\Catalog;

use Closure;
use Exception;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use MKD\MageplazaPreOrder\Helper\Data;
use Mageplaza\PreOrder\Model\Config\Source\Backorders;
use Mageplaza\PreOrder\Model\ResourceModel\Product\Attribute\UpdateHandler;

/**
 * Class Product
 * @package MKD\MageplazaPreOrder\Plugin\Model\Catalog
 */
class Product extends \Mageplaza\PreOrder\Plugin\Model\Catalog\Product
{

    public function aroundSave(\Magento\Catalog\Model\ResourceModel\Product $subject, Closure $proceed, $product)
    {
        $data = $product->getData();
        $result = $proceed($product);
        if ($product->getId() && isset($data['stock_data']['backorders'])) {

            $time = isset($data[Data::DELIVERY_TIME_ATTR]) ? $data[Data::DELIVERY_TIME_ATTR] : '';
            $product->setData(Data::DELIVERY_TIME_ATTR, $time);

            /** @var \Magento\Catalog\Model\ResourceModel\Product $resource */
            $resource = $product->getResource();
            $resource->saveAttribute($product, Data::DELIVERY_TIME_ATTR);
        }

        return $result;
    }
}
