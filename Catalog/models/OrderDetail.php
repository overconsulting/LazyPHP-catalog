<?php

namespace Catalog\models;

use Core\Model;

class OrderDetail extends Model
{
    protected $permittedColumns = array(
        'order_id',
        'product_id',
        'quantity',
        'amount'
    );

    public function getAssociations()
    {
        return array(
            'order' => array(
                'type' => '1',
                'model' => 'Order',
                'key' => 'order_id'
            ),
            'product' => array(
                'type' => '1',
                'model' => 'Product',
                'key' => 'product_id'
            )
        );
    }
}
