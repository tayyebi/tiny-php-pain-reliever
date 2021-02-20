<?php if ($Data['Add'] == false) goto add; ?>
<h1>بلوک <?php echo $Data['Model'] ?> اضافه شد</h1>
<a href="TrustChain">بازگشت</a>
<?php
// Segmentation
return;
add:
// End of Segmentation
?>
<h1>افزودن بلوک جدید</h1>
<form class="submit-form" method="post">
   <div class="form-group"><label for="Value">مقدار</label><input class="form-control" type="text" name="Value" value="" ></div>
   <input name="insert" type="submit" value="ارسال" class="btn btn-default background-gold">
</form>
<h1>زنجیره‌ی اعتماد</h1>
<?php
foreach ($Data['Model'] as $item) { ?>
<hr/>
<div>
   value: <?php echo $item['Value'] ?>
   <br/>
   hash: <?php echo $item['Hash'] ?>
   <br/>
   Recalculated: <?php echo $item['Recalculated'] ?>
   <br/>
   Verified: <?php echo $item['Verified'] ?>
</div>
<?php } ?>