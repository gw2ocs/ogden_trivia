<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<?= $this->element('head') ?>
<body>
    <?= $this->element('header') ?>
    <?= $this->Flash->render() ?>
    <main class="container clearfix">
        <?= $this->element('breadcrumbs') ?>
        <?= $this->fetch('content') ?>
    </main>
    <?= $this->element('footer') ?>
</body>
</html>
