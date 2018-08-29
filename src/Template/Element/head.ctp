<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title . ' - ' . $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('favicon.png', '/favicon.png', ['type' => 'icon']) ?>

	<?= $this->Html->css('normalize.css') ?>
    <?= $this->Html->css('gw2icon.min.css') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->Html->script('cookie.js'); ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script('ui.js', ['defer' => true]); ?>
</head>
