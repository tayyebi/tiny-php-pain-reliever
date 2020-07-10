<!-- Categories -->
<h1 class="h1" >همراه شما در <b>مسیر</b> آرزو‌ها</h1>
<ul class="roads">
<?php
foreach ($Data['Models']['Roads'] as $item) {
?>
<li class="background-gold border-radius">
    <a><?php echo $item['Title']?></a>
</li>
<?php
}
?>
</ul>
<!-- End of Categories -->

<!-- Categories -->
<h1 class="h1" ><b>کلیدواژه</b>‌ها، ایده‌هایی برای جستجو</h1>
<ul class="background-white categories overflow" >
<?php
foreach ($Data['Models']['Keywords'] as $item) {
?>
<li class="background-dark color-white border-radius"><a class="btn profile-edit-btn" href="index.php?q=<?php echo $item['Title'] ?>"><?php echo $item['Title'] ?></a></li>
<?php
}
?>
</ul>
<!-- End of Categories -->

<!-- Podcast -->
<h1 class="h1" ><b>پادکست</b>؛ مطالب شنیداری تحریریه</h1>
<div class="background-dark color-white podcast border-radius">
<?php
foreach ($Data['Models']['Podcasts'] as $item) {
?>
<h1><?php echo $item['Title'] ?></h1>
<h2><?php echo $item['PublishDate'] ?></h2>
<audio controls preload="metadata" >
    <!-- <source src="myfile.ogg" type="audio/ogg"> -->
    <source src="<?php echo $item['FileUrl'] ?>" type="audio/mpeg">
    مرورگر شما از پخش کننده‌ی صدا پشتیبانی نمی‌کند/
    <a href="<?php echo $item['FileUrl'] ?>">
    دانلود
    </a>
</audio>
<?php
}
?>
</div>
<!-- End of Podcast -->

<!-- Posts -->
<h1 class="h1" ><b>پست‌ها</b>ی گردآوری شده</h1>
<div class="gallery" id="Posts">
<?php
foreach ($Data['Models']['Posts'] as $item) {
?>
    <div class="gallery-item" tabindex="0" >
        <div class="gallery-item card">
            <a class="gallery-item-front background-dark color-white"
                href="<?php echo _Root . 'Home/Redirect/' . $item['Id'] ?>">
                <span><?php echo $item['Publisher'] ?></span>
                <h2 class="titles"><?php echo $item['Title'] ?></h2>
                <!-- <img src="image-generator.php?id=<?php echo $item['Id'] ?>" class="gallery-image" alt="<?php echo $item['Title'] ?>"> -->
            </a>
            <div class="gallery-item-back background-gold color-dark">
                <a href="<?php echo _Root . 'Home/View/' . $item['Id'] ?>" class="buttons"><span>بیشتر بدانید</span></a>
                <span class="Paragraf"><?php
                $AllowedCharsLimit = 400;
                if(strlen($item['Abstract']) > $AllowedCharsLimit)
                    echo substr($item['Abstract'], 0, $AllowedCharsLimit)."...";
                else
                    echo $item['Abstract'];
                    ?></span>
            </div>
        </div>
    </div>

<?php
}
?>
</div>
<!-- End of Posts -->