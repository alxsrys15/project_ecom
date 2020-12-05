<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PackageRequest Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $package_id
 * @property int|null $status_id
 * @property string $payment_reference
 * @property string $payment_image
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Package $package
 * @property \App\Model\Entity\Status $status
 */
class PackageRequest extends Entity
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
        'package_id' => true,
        'status_id' => true,
        'payment_reference' => true,
        'payment_image' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'package' => true,
        'status' => true,
    ];
}
