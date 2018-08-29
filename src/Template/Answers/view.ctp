<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Answer $answer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Answer'), ['action' => 'edit', $answer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Answer'), ['action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Answers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Answers'), ['controller' => 'Answers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="answers view large-9 medium-8 columns content">
    <h3><?= h($answer->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Content') ?></th>
            <td><?= h($answer->content) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $answer->has('question') ? $this->Html->link($answer->question->title, ['controller' => 'Questions', 'action' => 'view', $answer->question->slug]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($answer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Answer Id') ?></th>
            <td><?= $this->Number->format($answer->answer_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($answer->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($answer->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Answers') ?></h4>
        <?php if (!empty($answer->answers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Question Id') ?></th>
                <th scope="col"><?= __('Answer Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($answer->answers as $answers): ?>
            <tr>
                <td><?= h($answers->id) ?></td>
                <td><?= h($answers->content) ?></td>
                <td><?= h($answers->question_id) ?></td>
                <td><?= h($answers->answer_id) ?></td>
                <td><?= h($answers->created) ?></td>
                <td><?= h($answers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Answers', 'action' => 'view', $answers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Answers', 'action' => 'edit', $answers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Answers', 'action' => 'delete', $answers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
