<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PayoutRequest Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property float|null $amount
 * @property int|null $status_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $peso_value
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Status $status
 */
class PayoutRequest extends Entity
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
        'amount' => true,
        'status_id' => true,
        'created' => true,
        'modified' => true,
        'peso_value' => true,
        'user' => true,
        'status' => true,
    ];
}
