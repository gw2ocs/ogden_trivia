<?php
use Migrations\AbstractMigration;

class CreateBase extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('categories');
        $table->addColumn('parent_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ])
        ->addColumn('lft', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ])
        ->addColumn('rght', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ])
        ->addColumn('name', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('description', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->create();

        $table = $this->table('questions');
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('points', 'integer', [
            'default' => 1,
            'null' => false,
        ])
        ->addColumn('category_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ])
        ->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addForeignKey('category_id', 'categories', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
        ->create();

        $table = $this->table('answers');
        $table->addColumn('content', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('question_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ])
        ->addColumn('answer_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ])
        ->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addForeignKey('question_id', 'questions', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->addForeignKey('answer_id', 'answers', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->create();

        $table = $this->table('tips');
        $table->addColumn('content', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('question_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ])
        ->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ])
        ->addForeignKey('question_id', 'questions', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->create();
    }
}
