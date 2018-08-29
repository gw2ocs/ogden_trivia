<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 * @property string $name
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ParentCategory $parent_category
 * @property \App\Model\Entity\ChildCategory[] $child_categories
 * @property \App\Model\Entity\Question[] $questions
 */
class Category extends Entity
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
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'name' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'parent_category' => true,
        'child_categories' => true,
        'questions' => true
    ];

	protected $_virtual = ['path'];

	protected function _getPath()
	{
		$names = [$this->_properties['name']];
		$current = $this->_properties['parent_category'] ?? null;
		while (!is_null($current)) {
			array_unshift($names, $current->_properties['name']);
			$current = $current->_properties['parent_category'] ?? null;
		}
		return implode(' > ', $names);
	}
}
