<?php
namespace MKD\MageplazaPreOrder\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Product;
use Mageplaza\PreOrder\Helper\Item;
use MKD\MageplazaPreOrder\Helper\Data;

/**
 * Class PreOrder
 * @package MKD\MageplazaPreOrder\Ui\DataProvider\Product\Form\Modifier
 */
class PreOrder extends \Mageplaza\PreOrder\Ui\DataProvider\Product\Form\Modifier\PreOrder
{
    public function modifyData(array $data)
    {
        /** @var Product $model */
        $model = $this->locator->getProduct();
        $modelId = $model->getId();
        $storeId = $model->getStoreId();
        $product = &$data[$modelId][self::DATA_SOURCE_DEFAULT];

        if (!isset($product['stock_data']['backorders'])) {
            return $data;
        }

        $type = $product['stock_data']['backorders'];

        /** @var \Magento\Catalog\Model\ResourceModel\Product $resource */
        $resource = $model->getResource();
        $cartLabel = $model->getData(Item::ADD_TO_CART_ATTR) ?: $resource->getAttributeRawValue(
            $modelId,
            Item::ADD_TO_CART_ATTR,
            $storeId
        );
        $stockLabel = $model->getData(Item::STOCK_LABEL_ATTR) ?: $resource->getAttributeRawValue(
            $modelId,
            Item::STOCK_LABEL_ATTR,
            $storeId
        );
        $deliveryDate = $model->getData(Item::DELIVERY_DATE_ATTR) ?: $resource->getAttributeRawValue(
            $modelId,
            Item::DELIVERY_DATE_ATTR,
            $storeId
        );
        $deliveryTime = $model->getData(Data::DELIVERY_TIME_ATTR) ?: $resource->getAttributeRawValue(
            $modelId,
            Data::DELIVERY_TIME_ATTR,
            $storeId
        );
        $typeofDeliveryTime = $model->getData(Data::TYPEOF_DELIVERY_TIME_ATTR) ?: $resource->getAttributeRawValue(
            $modelId,
            Data::TYPEOF_DELIVERY_TIME_ATTR,
            $storeId
        );

        if (empty($cartLabel)) {
            $cartLabel = $this->helper->determineAddToCartLabel($type);
        }
        if (empty($stockLabel)) {
            $stockLabel = $this->helper->determineStockStatusLabel($type);
        }
        if (empty($deliveryDate)) {
            $deliveryDate = '';
        }
        if (empty($deliveryTime)) {
            $deliveryTime = '';
        }
        if (empty($typeofDeliveryTime)) {
            $typeofDeliveryTime = '';
        }

        $product[Item::ADD_TO_CART_ATTR . '_backorder'] = $cartLabel;
        $product[Item::STOCK_LABEL_ATTR . '_backorder'] = $stockLabel;
        $product[Item::ADD_TO_CART_ATTR . '_preorder'] = $cartLabel;
        $product[Item::STOCK_LABEL_ATTR . '_preorder'] = $stockLabel;
        $product[Item::DELIVERY_DATE_ATTR] = $deliveryDate;
        $product[Data::DELIVERY_TIME_ATTR] = $deliveryTime;
        $product[Data::TYPEOF_DELIVERY_TIME_ATTR] = $typeofDeliveryTime;

        $useConfigLabel = !strlen($cartLabel) || $cartLabel == $this->helper->determineAddToCartLabel($type);
        $useConfigNotice = !strlen($stockLabel) || $stockLabel == $this->helper->determineStockStatusLabel($type);

        $product['use_config_mppo_add_to_cart_label_backorder'] = (string)$useConfigLabel;
        $product['use_config_mppo_stock_status_label_backorder'] = (string)$useConfigNotice;
        $product['use_config_mppo_add_to_cart_label_preorder'] = (string)$useConfigLabel;
        $product['use_config_mppo_stock_status_label_preorder'] = (string)$useConfigNotice;

        return $data;
    }
}
