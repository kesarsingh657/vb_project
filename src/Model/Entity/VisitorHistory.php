<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VisitorHistory Entity
 *
 * @property int $id
 * @property int $visitor_id
 * @property \Cake\I18n\Date|null $visit_date
 * @property \Cake\I18n\Time|null $visit_time
 * @property \Cake\I18n\DateTime|null $check_in_time
 * @property \Cake\I18n\DateTime|null $check_out_time
 * @property string|null $host_name
 * @property string|null $visit_reason
 * @property string|null $status
 * @property \Cake\I18n\DateTime|null $created
 *
 * @property \App\Model\Entity\Visitor $visitor
 */
class VisitorHistory extends Entity
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
        'visitor_id' => true,
        'visit_date' => true,
        'visit_time' => true,
        'check_in_time' => true,
        'check_out_time' => true,
        'host_name' => true,
        'visit_reason' => true,
        'status' => true,
        'created' => true,
        'visitor' => true,
    ];
}
