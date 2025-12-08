<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VisitorReason Entity
 *
 * @property int $id
 * @property string $visit_reason
 * @property \Cake\I18n\DateTime|null $created_on
 * @property string|null $created_by
 * @property bool|null $status
 */
class VisitorReason extends Entity
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
        'visit_reason' => true,
        'created_on' => true,
        'created_by' => true,
        'status' => true,
    ];
}
