<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Block Entity.
 */
class Block extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'copy_id' => true,
        'handler' => true,
        'title' => true,
        'description' => true,
        'body' => true,
        'visibility' => true,
        'pages' => true,
        'locale' => true,
        'settings' => true,
        'status' => true,
        'copy' => true,
        'block_regions' => true,
        'roles' => true,
    ];
}
