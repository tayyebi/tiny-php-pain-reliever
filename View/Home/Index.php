<!-- Categories -->
<h1>کلید‌واژه‌ها</h1>
<ul class="categories" >
<?php
foreach ($Data['Models']['Keywords'] as $item) {
?>
<li><a class="btn profile-edit-btn" href="index.php?q=<?php echo $item['Title'] ?>"><?php echo $item['Title'] ?></a></li>
<?php
}
?>
</ul>
<!-- End of Categories -->

<!-- Podcast -->
<h1>پادکست</h1>
<div class="podcast">
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
<h1>مطالب</h1>
<div class="gallery">
<?php
foreach ($Data['Models']['Posts'] as $item) {
?>
    <div class="gallery-item" tabindex="0" >
        <div class="gallery-item card">
            <div class="gallery-item-front">
                <h2 class="titles"><?php echo $item['Title'] ?></h2>
                <!-- <img src="image-generator.php?id=<?php echo $item['Id'] ?>" class="gallery-image" alt="<?php echo $item['Title'] ?>"> -->
            </div>
            <div class="gallery-item-back">
                <div class="gallery-item-back-content ">
                        <span class="Paragraf"><?php
                        $AllowedCharsLimit = 400;
                        if(strlen($item['Abstract']) > $AllowedCharsLimit)
                            echo substr($item['Abstract'], 0, $AllowedCharsLimit)."...";
                        else
                            echo $item['Abstract'];
                            ?></span>

                        <a href="view.php?id=<?php echo $item['Id'] ?>" class="buttons"><span>بیشتر بدانید</span></a>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>
</div>
<!-- End of Posts -->