<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $Data['Title'] ?></title>

    <link rel="manifest" href="manifest.json">
    
    <link rel="stylesheet" href="<?php echo _Root ?>static/css/sariab.css">
    <link rel="stylesheet" href="<?php echo _Root ?>static/css/layout.css">
    <link rel="stylesheet" href="<?php echo _Root ?>static/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.css">
  
</head>
<body>
<header class="container background-white color-dark">
    <div class="profile">
        <div class="profile-image">
        <a href="http://sariab.ir">
		<img class=" background-dark color-white border-rounded" width="150" src="<?php echo _Root ?>logo/Icon.svg" alt="Sariab Logo">
        </a>
        </div>
        <div class="profile-user-settings">
            <h1 class="profile-user-name box-with-text background-dark">sariabbloggers</h1>
            <span class="profile-real-name"><strong>ساریاب</strong>
            گردآوری و اشتراک دانش و تجربه؛ و ایجاد انگیزه.</span>
        </div>
        <div class="searchbox-container">
            <form class="searchbox" method="GET" action="<?php echo _Root . 'Home/Index' ?>" >
                <input class="search-txt color-white border-radius background-gold" type="text" name="q" placeholder="جستجو...">
                <button type="submit" class="border-rounded search-btn background-dark color-white" >
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
        </div>
        <div class="contribute-links">
            <a class="profile-edit-btn background-dark color-white border-radius" href="<?php echo _Root ?>Home/Submit">ارسال مطلب</a>
            <a class="profile-edit-btn background-dark color-white border-radius" href="<?php echo _Root ?>Home/Positions">عضویت ساریاب</a>
            <a class="profile-edit-btn background-gold color-dark border-radius shine" href="https://zarinp.al/@tayyebi">حمایت از ساریاب</a>
        </div>
        <div class="social-button">
            <a href="https://instagram.com/sariabbloggers" class="border-rounded icon insta background-dark color-white">
                <span class="background-dark color-white border-radius">اینستاگرام</span>
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.linkedin.com/company/sariab/" class="border-rounded icon insta background-dark color-white">
                <span class="background-dark color-white border-radius">لینکداین</span>
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="https://t.me/sariabbloggers"class="border-rounded icon tel background-dark color-white">
                <span class="background-dark color-white border-radius">تلگرام</span> 
                <i class="fab fa-telegram"></i>
            </a>
            <a href="https://github.com/Pressz/Sariab-V2"class="border-rounded icon git background-dark color-white">
                <span class="background-dark color-white border-radius">متن باز</span>
                <i class="fab fa-github"></i>
            </a>
            <a href="https://vrgl.ir/D2lo5"class="border-rounded icon faq background-dark color-white">
                <span class="background-dark color-white border-radius">سوالات پرتکرار (FAQ)</span>
                <i class="fa fa-question"></i>
            </a>
            <a href="<?php echo _Root ?>Home/ThankYou"class="border-rounded icon heart background-dark color-white">
                <span class="background-dark color-white border-radius">قدردانی</span>
                <i class="fa fa-heart"></i>
            </a>
            <a href="<?php echo _Root ?>Home/RSS"class="border-rounded icon rss background-dark color-white">
                <span class="background-dark color-white border-radius">خوراک</span>
                <i class="fa fa-rss"></i>
            </a>
            <a href="<?php echo _Root ?>Home/Blog"class="border-rounded icon blog background-dark color-white">
                <span class="background-dark color-white border-radius">بلاگ</span>
                <i class="fa fa-blog"></i>
            </a>
        </div>
    </div>
    <!-- End of profile section -->
</header>

<main class="container background-white color-dark">
<!--VIEW_CONTENT-->
<div class="cookie-container background-dark color-white">
<p class="cookie-p">
we care about your data, and we'd use cookies only to improve your experience</br>
ما همچنین از کوکی‌ها برای بهبود کیفیت خدمات استفاده می‌کنیم
</p>
    <button class="cookie-btn background-gold">
        قوانین را قبول دارم
    </button>
    <a class="cookie-btn background-gold color-dark" target="_blank" href="<?php _Root ?>Home/Rules">مرور قوانین</a>
</div>
</main>

<script>
// PWA
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('<?php echo _Root ?>static/js/service-worker.js').then(function(reg){
    }).catch(function(err) {
    console.log("Failed to register service-worker.js: ", err)
    });
}
//Cookies Use 
const cookieContainer =document.querySelector(".cookie-container");
const cookieButton=document.querySelector("button.cookie-btn");
cookieButton.addEventListener("click",()=>{
    cookieContainer.classList.remove("active");
    localStorage.setItem("cookieBannerDisplaye","true")
})
setTimeout(() => {
    if(!localStorage.getItem("cookieBannerDisplaye"))
         cookieContainer.classList.add("active")
    },1000);
    //End Cookies Use
</script>

</body>
</html>