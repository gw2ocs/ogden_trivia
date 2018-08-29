<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tip[]|\Cake\Collection\CollectionInterface $tips
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tip'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tips index large-9 medium-8 columns content">
    <h3><?= __('Tips') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('content') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tips as $tip): ?>
            <tr>
                <td><?= $this->Number->format($tip->id) ?></td>
                <td><?= h($tip->content) ?></td>
                <td><?= $tip->has('question') ? $this->Html->link($tip->question->title, ['controller' => 'Questions', 'action' => 'view', $tip->question->slug]) : '' ?></td>
                <td><?= h($tip->created) ?></td>
                <td><?= h($tip->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tip->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tip->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tip->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tip->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
