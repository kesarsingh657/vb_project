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
