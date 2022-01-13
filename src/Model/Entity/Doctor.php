<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Doctor Entity
 *
 * @property int $id
 * @property string $name
 * @property int $department_id
 * @property string $email
 * @property string $password
 *
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Appoint[] $appoints
 */
class Doctor extends Entity
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
        'name' => true,
        'department_id' => true,
        'email' => true,
        'password' => true,
        'department' => true,
        'appoints' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
