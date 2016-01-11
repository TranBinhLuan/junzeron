<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * News Entity.
 */
class News extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'description' => true,
        'terms_id' => true,
        'created_at' => true,
        'deleted_at' => true,
        'term' => true,
    ];
}
