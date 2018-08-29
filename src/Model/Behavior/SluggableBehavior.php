<?php
namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\Utility\Text;

class SluggableBehavior extends Behavior
{
	protected $_defaultConfig = [
        'field' => 'title',
        'slug' => 'slug',
        'replacement' => '-',
    ];

    public function slug(Entity $entity)
    {
        $config = $this->getConfig();
        $value = mb_strtolower($entity->get($config['field']));
        $entity->set($config['slug'], Text::slug($value, $config['replacement']));
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        $this->slug($entity);
    }

	public function findSlug(Query $query, array $options)
	{
	    return $query->where([$this->_table->getAlias() . '.slug' => $options['slug']]);
	}
}
