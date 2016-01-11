<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Exchange Entity.
 */
class Exchange extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'exchange_type_id' => true,
        'settings' => true,
        'update_at' => true,
        'exchange_type' => true,
    ];
}
