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
    
    protected array $_accessible = [
        'visit_reason' => true,
        'created_on' => true,
        'created_by' => true,
        'status' => true,
    ];
}
