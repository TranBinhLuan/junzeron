<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity.
 */
class Order extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'customer_info' => true,
        'order_info' => true,
        'payment_infor' => true,
        'status' => true,
        'created_at' => true,
        'user' => true,
    ];
}
