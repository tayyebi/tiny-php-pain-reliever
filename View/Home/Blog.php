<link rel="stylesheet" href="<?php echo _Root ?>static/css/blog.css">
<?php
foreach ($Data['Model'] as $item) {
?>
<div class="item background-light color-dark font-large">
    <h3 class="font-xlarge"><?php echo $item['Title'] ?></h3>
    <span><?php echo $item['Submit'] ?></span>
    <p><?php echo $item['Body'] ?></p>
</div>
<?php
}
?>