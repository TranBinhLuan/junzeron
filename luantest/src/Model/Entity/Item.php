<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity.
 */
class Item extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'image' => true,
        'category_id' => true,
        'price' => true,
        'quantity' => true,
        'companypaint' => true,
        'created_at' => true,
        'category' => true,
    ];
}
