<link rel="stylesheet" href="<?php echo _Root ?>static/css/thankyou.css">
<?php
foreach ($Data['Model'] as $item) {
?>
<div class="item">
    <h3><?php echo $item['Name'] ?></h3>
    <a href="<?php echo $item['Url'] ?>">🔗</a>
</div>
<?php
}
?>