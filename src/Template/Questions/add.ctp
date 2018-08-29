<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<h2><?= __('Add a Question') ?></h2>
<div class="question form">
    <?= $this->Form->create($question) ?>
    <fieldset class="question-details">
        <legend><?= __('Edit Question') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('points');
            echo $this->Form->control('category_id', ['options' => $categories, 'empty' => true]);
        ?>
    </fieldset>
	<fieldset class="question-tips">
		<legend><?= __('Edit Tips') ?></legend>
        <div class="question-tips-container">
		<?php
			if (!empty($question->tips)) {
				foreach ($question->tips as $index => $tip) {
					echo $this->Form->control('tips.' . $index . '.id');
					echo $this->Form->control('tips.' . $index . '.content');
				}
			} else {
				echo $this->Form->control('tips.0.id');
				echo $this->Form->control('tips.0.content');
			}
		?>
        </div>
		<button type="button" class="button js-add-tip">Add a new tip</button>
	</fieldset>
	<fieldset class="question-answers">
		<legend><?= __('Edit Answers') ?></legend>
        <div class="question-answers-container">
		<?php
			if (!empty($question->answers)) {
				foreach ($question->answers as $index => $answer) {
					echo $this->Form->control('answers.' . $index . '.id');
					echo $this->Form->control('answers.' . $index . '.content');
				}
			} else {
				echo $this->Form->control('answers.0.id');
				echo $this->Form->control('answers.0.content');
			}
		?>
        </div>
		<button type="button" class="button js-add-answer">Add a new answer</button>
	</fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button button-primary']) ?>
    <template id="new-tip">
    <?php
        echo $this->Form->control('tips.000.id');
        echo $this->Form->control('tips.000.content');
    ?>
    </template>
    <template id="new-answer">
    <?php
        echo $this->Form->control('answers.000.id');
        echo $this->Form->control('answers.000.content');
    ?>
    </template>
    <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
	const tipContainer = document.querySelector('.question-tips-container');
    const answerContainer = document.querySelector('.question-answers-container');
	if ('content' in document.createElement('template')) {
        document.querySelector('.js-add-tip').addEventListener('click', () => {
            const count = tipContainer.querySelectorAll('input[id$=-content]');
            const newTip = document.querySelector('#new-tip');
            const tip = document.importNode(newTip.content, true);
            Object.assign(tip.querySelector('#tips-000-id'), {
                id: `tips-${count.length}-id`,
                name: `tips[${count.length}][id]`
            });
            Object.assign(tip.querySelector('label'), {
                htmlFor: `tips-${count.length}-content`
            });
            Object.assign(tip.querySelector('#tips-000-content'), {
                id: `tips-${count.length}-content`,
                name: `tips[${count.length}][content]`
            });
            tipContainer.appendChild(tip);
        });
        document.querySelector('.js-add-answer').addEventListener('click', () => {
            const count = answerContainer.querySelectorAll('input[id$=-content]');
            const newAnswer = document.querySelector('#new-answer');
            const answer = document.importNode(newAnswer.content, true);
            Object.assign(answer.querySelector('#answers-000-id'), {
                id: `answers-${count.length}-id`,
                name: `answers[${count.length}][id]`
            });
            Object.assign(answer.querySelector('label[for=answers-000-content]'), {
                htmlFor: `answers-${count.length}-content`
            });
            Object.assign(answer.querySelector('#answers-000-content'), {
                id: `answers-${count.length}-content`,
                name: `answers[${count.length}][content]`
            });
            answerContainer.appendChild(answer);
        });
    }
</script>
