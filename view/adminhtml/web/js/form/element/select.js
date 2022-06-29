define(['uiRegistry'], function (registry) {
    'use strict';

    return function (Component) {
        return Component.extend({
            initialize: function () {
                this._super();

                this.toggleDeliveryElem();

                return this;
            },

            onUpdate: function () {
                this._super();

                this.toggleDeliveryElem();
            },

            toggleDeliveryElem: function () {
                var formName = registry.get(this.parentName).parentName,
                    fieldDeliveryDate = registry.get(formName + '.container_mppo_delivery_date'),
                    fieldDeliveryTime = registry.get(formName + '.container_mppo_delivery_time'),
                    backorders = registry.get(formName + '.container_backorders.backorders'),
                    delivery = registry.get(formName + '.container_mppo_typeof_delivery_time.mppo_typeof_delivery_time');

                if (this.index === 'mppo_typeof_delivery_time') {

                    fieldDeliveryDate.visible(false);
                    fieldDeliveryTime.visible(false);

                    switch (this.value()) {
                        case 'date':
                            if (backorders.value() === 0) {
                                fieldDeliveryDate.visible(false);
                                fieldDeliveryTime.visible(false);
                            } else {
                                fieldDeliveryDate.visible(true);
                                fieldDeliveryTime.visible(false);
                            }

                            break;
                        case 'time':
                            if (backorders.value() === 0) {
                                fieldDeliveryDate.visible(false);
                                fieldDeliveryTime.visible(false);
                            } else {
                                fieldDeliveryDate.visible(false);
                                fieldDeliveryTime.visible(true);
                            }
                            break;
                    }
                }

                if (this.index === 'backorders') {

                    if (this.value() === 0) {
                        fieldDeliveryDate.visible(false);
                        fieldDeliveryTime.visible(false);
                    } else {
                        if (delivery.value() === 'date')
                            fieldDeliveryDate.visible(true);
                        else if (delivery.value() === 'time')
                            fieldDeliveryTime.visible(true);

                    }
                }

            },

        })
    }
});
