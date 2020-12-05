<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string $password
 * @property float|null $coins_balance
 * @property string|null $contact_no
 * @property int|null $is_admin
 * @property string|null $activation_token
 * @property string|null $reset_token
 * @property int|null $is_active
 * @property string|null $invite_code
 * @property string|null $avatar_image
 * @property int|null $parent_id
 * @property int|null $lft
 * @property int|null $rght
 * @property int|null $level
 * @property string|null $userscol
 * @property int|null $invited_by
 *
 * @property \App\Model\Entity\User $parent_user
 * @property \App\Model\Entity\ActivationCode[] $activation_codes
 * @property \App\Model\Entity\PackageRequest[] $package_requests
 * @property \App\Model\Entity\PostComment[] $post_comments
 * @property \App\Model\Entity\Post[] $posts
 * @property \App\Model\Entity\User[] $child_users
 */
class User extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'password' => true,
        'coins_balance' => true,
        'contact_no' => true,
        'is_admin' => true,
        'activation_token' => true,
        'reset_token' => true,
        'is_active' => true,
        'invite_code' => true,
        'avatar_image' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'level' => true,
        'userscol' => true,
        'invited_by' => true,
        'parent_user' => true,
        'activation_codes' => true,
        'package_requests' => true,
        'post_comments' => true,
        'posts' => true,
        'child_users' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }
}
