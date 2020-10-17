<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EBook Entity
 *
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string|null $year_published
 * @property string|null $description
 * @property string $cover_images
 * @property float $cash_price
 * @property float $coins_price
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class EBook extends Entity
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
        'title' => true,
        'author' => true,
        'year_published' => true,
        'description' => true,
        'cover_images' => true,
        'cash_price' => true,
        'coins_price' => true,
        'created' => true,
        'modified' => true,
    ];
}
