<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivationCode Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $code
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $is_used
 *
 * @property \App\Model\Entity\User $user
 */
class ActivationCode extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'code' => true,
        'created' => true,
        'modified' => true,
        'is_used' => true,
        'user' => true,
    ];
}
