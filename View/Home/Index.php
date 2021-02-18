<!-- Roadmaps -->
<div class=" roads slideshow-container">
<?php
for ($i = 0 ; $i < count($Data['Models']['Roads']) ; $i ++ ) {
$item = $Data['Models']['Roads'][$i]
?>
  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    <a href="<?php echo _Root . 'Home/Roadmap/' . $item['Id']?>">
        <div class="numbertext"><?php echo $i + 1 ?> از <?php echo count($Data['Models']['Roads']) ?></div>
        <img src="<?php echo $item['ImageUrl'] ?>" style="width:100%">
        <div class="text">
            <?php echo $item['Title']?>
        </div>
    </a>
   </div>
<?php
}
?>
  <!-- Next and previous buttons -->
  <span class="prev" onclick="plusSlides(-1)">&#10094;</span>
  <span class="next" onclick="plusSlides(1)">&#10095;</span>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
<?php for ($i = 0 ; $i < count($Data['Models']['Roads']) ; $i ++ ) { ?>
  <span class="dot" onclick="currentSlide(<?php echo $i + 1 ?>)"></span>
<?php } ?>
</div>

<!-- JavaScript -->
<script>
var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
</script>
<!-- End of Roadmaps -->

<!-- Podcast -->
<?php
foreach ($Data['Models']['Podcasts'] as $item) {
?>
<h1 class="h1" ><b>بشنوید:</b> <?php echo $item['Title'] ?></h1>
<div class="background-dark color-white podcast border-radius">
    <audio controls preload="metadata" >
        <!-- <source src="myfile.ogg" type="audio/ogg"> -->
        <source src="<?php echo $item['FileUrl'] ?>" type="audio/mpeg">
        مرورگر شما از پخش کننده‌ی صدا پشتیبانی نمی‌کند
        <a href="<?php echo $item['FileUrl'] ?>">
        دانلود
        </a>
    </audio>
    <h2><?php echo $item['PublishDate'] ?></h2>
    <span><a href="https://vrgl.ir/DwyG8" target="_blank">دنبال کردن پادکست در برنامه‌های مورد علاقه‌ی شما! (کلیک کنید)</a></span>
</div>
<?php
}
?>
<!-- End of Podcast -->

<!-- Hub -->
<h1 class="h1" >تازه‌ها؛ صفحه <?php echo $Data['PostsPage'] ?></h1>
<div class="hub-controls">
    <a href="<?php echo _Root . 'Home/Index/*/' . ($Data['PostsPage'] - 1) ?>#Hub">صفحه قبل</a>
    | <a href="<?php echo _Root . 'Home/Index/*/' . ($Data['PostsPage'] + 1) ?>#Hub">صفحه بعد</a>
    | <a href="<?php echo _Root ?>Home/RSS">خوراک</a>
</div>
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
        <a href="<?php echo _Root . 'Home/Redirect/' . $item['Id'] ?>" class="color-dark">
            <h2><?php echo $item['Title'] ?></h2>
        </a>
        <p>
            <?php echo $item['IsExternalWriter'] ? '<i class="fas fa-exclamation-circle tooltip"><span class="tooltiptext"> نویسنده غیر رسمی</span></i>' : $item['Publisher'] ?>
            | <?php echo time_elapsed_string($item['Submit']) ?>
            | <?php echo parse_url($item['Canonical'], PHP_URL_HOST) ?>
            | <a class="color-dark" href="<?php echo _Root . 'Home/View/' . $item['Id'] ?>">خلاصه</a>
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