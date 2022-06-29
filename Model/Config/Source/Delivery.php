<?php
namespace MKD\MageplazaPreOrder\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Delivery
 * @package MKD\MageplazaPreOrder\Model\Config\Source
 */
class Delivery implements OptionSourceInterface
{
    const DELIVERY_DATE = 'date';
    const DELIVERY_TIME = 'time';

    /**
     * @return array
     */
    public static function getOptionArray()
    {
        return [
            self::DELIVERY_DATE => __('Delivery Date'),
            self::DELIVERY_TIME => __('Delivery Time'),
        ];
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }
}
