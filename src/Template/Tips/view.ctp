<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tip $tip
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tip'), ['action' => 'edit', $tip->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tip'), ['action' => 'delete', $tip->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tip->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tips'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tip'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tips view large-9 medium-8 columns content">
    <h3><?= h($tip->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Content') ?></th>
            <td><?= h($tip->content) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $tip->has('question') ? $this->Html->link($tip->question->title, ['controller' => 'Questions', 'action' => 'view', $tip->question->slug]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tip->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($tip->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($tip->modified) ?></td>
        </tr>
    </table>
</div>
