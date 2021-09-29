<?php
include_once VIEWPATH . 'header.php';
?>
<div id="content">
    <?php
    $this->load->view($body_template);
    ?>
</div>
<?php
include_once VIEWPATH . 'footer.php';
?>