<link rel="stylesheet" href="<?php echo _Root ?>static/css/thankyou.css">
<div class="container items font-large">
<?php
foreach ($Data['Model'] as $item) {
?>
<div class="item background-dark color-white border-radius">
    <a class="" href="<?php echo $item['Url'] ?>">🔗</a>
    <h3><?php echo $item['Name'] ?></h3>
    <p><?php echo $item['About'] ?></p>
</div>
<?php
}
?>
</div>