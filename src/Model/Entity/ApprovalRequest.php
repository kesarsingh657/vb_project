<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApprovalRequest Entity
 *
 * @property int $id
 * @property int $visitor_id
 * @property string $host_email
 * @property string|null $host_phone
 * @property \Cake\I18n\DateTime|null $request_sent_at
 * @property \Cake\I18n\DateTime|null $approved_at
 * @property string|null $status
 * @property string|null $approval_token
 *
 * @property \App\Model\Entity\Visitor $visitor
 */
class ApprovalRequest extends Entity
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
        'host_email' => true,
        'host_phone' => true,
        'request_sent_at' => true,
        'approved_at' => true,
        'status' => true,
        'approval_token' => true,
        'visitor' => true,
    ];
}
