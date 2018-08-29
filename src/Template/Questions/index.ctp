<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question[]|\Cake\Collection\CollectionInterface $questions
 */
?>
<section class="questions index">
    <h2><?= __('Questions') ?></h2>
    <nav class="actions-nav">
        <ul>
            <li><?= $this->Html->link(__('New Question'), ['action' => 'add'], ['class' => 'button button-full button-primary']) ?></li>
        </ul>
    </nav>
    <nav class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first'), ['class' => 'button button-full']) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
    </nav>
    <table class="table-fullwidth">
        <thead>
        <tr>
            <th scope="col" style="width:100%;"><?= $this->Paginator->sort('title') ?></th>
            <th scope="col"><?= $this->Paginator->sort('points') ?></th>
            <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($questions as $question): ?>
            <tr>
                <td><?= $this->Html->link(h($question->title), ['action' => 'view', $question->slug], ['escape' => false]) ?></td>
                <td class="table-cell-numeric"><?= $this->Number->format($question->points) ?></td>
                <td><?= $question->has('category') ? $this->Html->link($question->category->name, ['controller' => 'Categories', 'action' => 'view', $question->category->id], ['title' => $question->category->path]) : '' ?></td>
                <td><?= h($question->created) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <nav class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first'), ['class' => 'button button-full']) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </nav>
</section>
