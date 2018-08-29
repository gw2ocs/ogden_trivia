<header class="main-header">
    <h1>
        <a href="/">
            <i class="gw2-knowledge-crystal"></i>
            <span><?= $title ?></span>
        </a>
    </h1>
    <nav class="header-nav">
        <?= $this->Html->link(
            '<i class="gw2-guild-panel-history gw2-2x nav-icon"></i> <span class="nav-label">' . __('Questions') . "</span>",
            ['controller' => 'Questions', 'action' => 'index'],
            ['class' => 'header-nav-link', 'escape' => false]
        ) ?>
    </nav>
</header>
