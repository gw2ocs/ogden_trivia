<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<h2><?= __('Edit a Question') ?></h2>
<div class="question form">
	<div class="control-container">
		<label for="switch-help">
			<input class="control-switch" type="checkbox" name="switch-help" id="switch-help" />
			<?= __('Display help') ?>
		</label>
	</div>
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
		<p class="form-help" hidden>
			<?= __('Define here the tip(s) associated to this question. It can be a word, a name, a sentence, a link ... It will be displayed wen time starts running out.') ?>
		</p>
        <div class="question-tips-container">
		<?php
			if (!empty($question->tips)) {
				foreach ($question->tips as $index => $tip) {
					echo $this->Form->control('tips.' . $index . '.id');
					echo $this->Form->control('tips.' . $index . '.content', ['label' => false]);
				}
			} else {
				echo $this->Form->control('tips.0.id');
				echo $this->Form->control('tips.0.content', ['label' => false]);
			}
		?>
        </div>
		<button type="button" class="button js-add-tip">Add a new tip</button>
	</fieldset>
	<fieldset class="question-answers">
		<legend><?= __('Edit Answers') ?></legend>
		<p class="form-help" hidden>
			<?= __('Define here the answer(s) associated to this question. Each line represents one possible answer, and whenever an user gives a response validating the condition of one line, he wins the quiz.') ?>
		</p>
        <div class="question-answers-container">
		<?php
			if (!empty($question->answers)) {
				foreach ($question->answers as $index => $answer) {
					echo $this->Form->control('answers.' . $index . '.id');
					echo $this->Form->control('answers.' . $index . '.content', ['label' => false]);
				}
			} else {
				echo $this->Form->control('answers.0.id');
				echo $this->Form->control('answers.0.content', ['label' => false]);
			}
		?>
        </div>
		<button type="button" class="button js-add-answer">Add a new answer</button>
	</fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button button-primary']) ?>
    <template id="new-tip">
    <?php
        echo $this->Form->control('tips.000.id');
        echo $this->Form->control('tips.000.content', ['label' => false]);
    ?>
    </template>
    <template id="new-answer">
    <?php
        echo $this->Form->control('answers.000.id');
        echo $this->Form->control('answers.000.content', ['label' => false]);
    ?>
    </template>
    <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
	const helpSwitch = document.querySelector('#switch-help');
	if (helpSwitch) {
        helpSwitch.addEventListener('change', () => {
            const {checked} = helpSwitch;
            document.querySelectorAll('.form-help').forEach(help => checked ? help.removeAttribute('hidden') : help.setAttribute('hidden', ''));
            if (checked) {
                docCookies.setItem('formHelp', true);
            } else {
                docCookies.removeItem('formHelp');
            }
        });
        if (docCookies.hasItem('formHelp') !== helpSwitch.checked) {
            helpSwitch.click();
        }
    }

	const tipContainer = document.querySelector('.question-tips-container');
    const answerContainer = document.querySelector('.question-answers-container');
	if ('content' in document.createElement('template')) {
	    if (tipContainer) {
            document.querySelector('.js-add-tip').addEventListener('click', () => {
                const count = tipContainer.querySelectorAll('input[id$=-content]');
                const newTip = document.querySelector('#new-tip');
                const tip = document.importNode(newTip.content, true);
                Object.assign(tip.querySelector('#tips-000-id'), {
                    id: `tips-${count.length}-id`,
                    name: `tips[${count.length}][id]`
                });
                Object.assign(tip.querySelector('#tips-000-content'), {
                    id: `tips-${count.length}-content`,
                    name: `tips[${count.length}][content]`
                });
                tipContainer.appendChild(tip);
            });
        }
        if (answerContainer) {
            document.querySelector('.js-add-answer').addEventListener('click', () => {
                const count = answerContainer.querySelectorAll('input[id$=-content]');
                const newAnswer = document.querySelector('#new-answer');
                const answer = document.importNode(newAnswer.content, true);
                Object.assign(answer.querySelector('#answers-000-id'), {
                    id: `answers-${count.length}-id`,
                    name: `answers[${count.length}][id]`
                });
                Object.assign(answer.querySelector('#answers-000-content'), {
                    id: `answers-${count.length}-content`,
                    name: `answers[${count.length}][content]`
                });
                answerContainer.appendChild(answer);
            });
        }
    }
</script>
