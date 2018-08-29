<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Answer Entity
 *
 * @property int $id
 * @property string $content
 * @property int $question_id
 * @property int $answer_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Question $question
 * @property \App\Model\Entity\Answer[] $answers
 */
class Answer extends Entity
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
        'content' => true,
        'question_id' => true,
        'answer_id' => true,
        'created' => true,
        'modified' => true,
        'question' => true,
        'answers' => true
    ];
}
