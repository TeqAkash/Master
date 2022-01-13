<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Appoint Entity
 *
 * @property int $id
 * @property int $patient_id
 * @property int $doctor_id
 * @property \Cake\I18n\FrozenTime $appoint_date
 * @property string $payment
 * @property string $status
 *
 * @property \App\Model\Entity\Patient $patient
 * @property \App\Model\Entity\Doctor $doctor
 */
class Appoint extends Entity
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
        'patient_id' => true,
        'doctor_id' => true,
        'appoint_date' => true,
        'payment' => true,
        'status' => true,
        'patient' => true,
        'doctor' => true,
    ];
}
