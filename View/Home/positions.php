<link rel="stylesheet" href="<?php echo _Root ?>static/css/positions.css">
<?php
foreach ($Data['Model'] as $item) {
?>
<div class="item background-dark color-white font-large">
    <h3 class="font-xlarge"><?php echo $item['Title'] ?></h3>
    <p><?php echo $item['JobDescription'] ?></p>
</div>
<?php
}
?>
