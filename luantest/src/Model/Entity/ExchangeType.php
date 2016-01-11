<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExchangeType Entity.
 */
class ExchangeType extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'descriptions' => true,
        'slug' => true,
        'settings' => true,
        'exchanges' => true,
    ];
}
