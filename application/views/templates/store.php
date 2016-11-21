<?php
    $this->view('templates/header');
    $this->view('templates/menu');
?>
<div class="container">
    <?php if (isset($flashMessage) && $flashMessage !== FALSE): ?>
    <div class="alert alert-<?= key($flashMessage); ?>"><?= current($flashMessage); ?></div>
    <?php endif; ?>
    <?php if (isset($templatePage)) $this->view($templatePage); ?>
</div>
<?php $this->view('templates/footer'); ?>