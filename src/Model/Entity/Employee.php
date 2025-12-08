<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string $employee_name
 * @property string $employee_email
 * @property string|null $employee_phone
 * @property string|null $department
 * @property string|null $designation
 * @property bool|null $is_active
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 */
class Employee extends Entity
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
        'employee_name' => true,
        'employee_email' => true,
        'employee_phone' => true,
        'department' => true,
        'designation' => true,
        'is_active' => true,
        'created' => true,
        'modified' => true,
    ];
}
