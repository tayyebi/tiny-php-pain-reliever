<!-- Roadmaps -->
<h1 class="h1" >همراه شما در <b>مسیر</b> آرزو‌ها</h1>
<ul class="roads">
<?php
foreach ($Data['Models']['Roads'] as $item) {
?>
<li class="background-gold border-radius">
    <a href="<?php echo _Root . 'Home/Roadmap/' . $item['Id']?>"
    ><?php echo $item['Title']?></a>
</li>
<?php
}
?>
</ul>
<!-- End of Roadmaps -->

<!-- Podcast -->
<?php
foreach ($Data['Models']['Podcasts'] as $item) {
?>
<h1 class="h1" ><b>بشنوید:</b> <?php echo $item['Title'] ?></h1>
<div class="background-dark color-white podcast border-radius">
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

<!-- Hub -->
<h1 class="h1" ><b>هاب</b> تازه‌ها؛ صفحه <?php echo $Data['PostsPage'] ?></h1>
<a href="<?php echo _Root . 'Home/Index/*/' . ($Data['PostsPage'] + 1) ?>#Hub">صفحه بعد</a>
<a href="<?php echo _Root . 'Home/Index/*/' . ($Data['PostsPage'] - 1) ?>#Hub">صفحه قبل</a>
<?php
if (count($Data['Models']['Posts']) == 0) {
?>
<strong>هیچ پستی یافت نشد</strong>
<?php
}
else
{
?>
<ol class="hub" id="Hub">
<?php
    foreach ($Data['Models']['Posts'] as $item)
    {
?>
    <li>
        <a href="<?php echo _Root . 'Home/Redirect/' . $item['Id'] ?>">
            <h2><?php echo $item['Title'] ?></h2>
        </a>
        <p>
            <?php echo $item['IsExternalWriter'] ? '<span title="نویسنده‌ی غیر رسمی">❗</span>' : $item['Publisher'] ?>
            | <?php echo time_elapsed_string($item['Submit']) ?>
        </p>
        <?php /*
        <p><?php
            $AllowedCharsLimit = 400;
            if(strlen(strip_tags($item['Abstract'])) > $AllowedCharsLimit)
                echo substr(strip_tags($item['Abstract']), 0, $AllowedCharsLimit)."...";
            else
                echo strip_tags($item['Abstract']);
        ?></p>
        */ ?>
    </li>
<?php
    }
?>
</ol>
<?php
}
?>
<!-- End of Hub -->

<!-- Categories -->
<h1 class="h1" ><b>کلیدواژه</b>‌ها، ایده‌هایی برای جستجو</h1>
<ul class="background-white categories overflow" >
<?php
foreach ($Data['Models']['Keywords'] as $item) {
?>
<li class="background-dark color-white border-radius"><a class="btn profile-edit-btn" href="<?php echo _Root . 'Home/Index/' . $item['Title'] . '#Posts'?>"><?php echo $item['Title'] ?></a></li>
<?php
}
?>
</ul>
<!-- End of Categories -->