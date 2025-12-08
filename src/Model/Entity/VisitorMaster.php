<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VisitorMaster Entity
 *
 * @property int $id
 * @property string $visitor_name
 * @property string $mobile_number
 * @property string|null $email
 * @property string|null $address
 * @property string|null $company_name
 * @property string|null $photo
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 */
class VisitorMaster extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'visitor_name' => true,
        'mobile_number' => true,
        'email' => true,
        'address' => true,
        'company_name' => true,
        'photo' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
