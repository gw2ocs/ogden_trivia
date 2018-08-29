<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<section class="questions view">
    <h2><?= h($question->title) ?></h2>
    <nav class="actions-nav">
        <ul>
            <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $question->slug], ['class' => 'button button-full button-primary']) ?></li>
        </ul>
    </nav>
    <dl class="question-details">
        <dt><?= __('Category:') ?></dt>
        <dd><?= $question->has('category') ? $this->Html->link($question->category->name, ['controller' => 'Categories', 'action' => 'view', $question->category->slug], ['title' => $question->category->path]) : '' ?></dd>
        <dt><?= __('Points:') ?></dt>
        <dd><?= $this->Number->format($question->points) ?></dd>
        <dt><?= sprintf(__('Added on %s'), h($question->created)) ?></dt>
        <dt><?= sprintf(__('Last modification on %s'), h($question->modified)) ?></dt>
    </dl>
    <details class="question-tips">
        <summary><?= __('Related Tips') ?></summary>
        <?php if (!empty($question->tips)): ?>
            <ul>
                <?php foreach ($question->tips as $tip): ?>
                    <li><?= $this->Html->link($tip->content, ['controller' => 'Tips', 'action' => 'view', $tip->id]) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </details>
    <details class="question-answers">
        <summary><?= __('Related Answers') ?></summary>
        <?php if (!empty($question->answers)): ?>
            <ul>
                <?php foreach ($question->answers as $answer): ?>
                    <li><?= $this->Html->link($answer->content, ['controller' => 'Answers', 'action' => 'view', $answer->id]) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </details>
</section>
