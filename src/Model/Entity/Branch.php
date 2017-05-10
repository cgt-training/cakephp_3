<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Branch Entity
 *
 * @property int $branch_id
 * @property int $company_fk_id
 * @property string $branch_name
 * @property \Cake\I18n\Time $branch_created
 *
 * @property \App\Model\Entity\Branch $branch
 * @property \App\Model\Entity\Company $company
 */
class Branch extends Entity
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
        '*' => true,
        'branch_id' => false
    ];
}
