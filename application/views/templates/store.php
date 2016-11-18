<?php
$this->view('templates/header', array('title' => $title));
$this->view('templates/menu');
?>
<div class="container">
    <?php $this->view($template_page); ?>
</div>
<?php $this->view('templates/footer'); ?>