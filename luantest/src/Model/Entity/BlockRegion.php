<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BlockRegion Entity.
 */
class BlockRegion extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'block_id' => true,
        'theme' => true,
        'region' => true,
        'ordering' => true,
        'block' => true,
    ];
}
