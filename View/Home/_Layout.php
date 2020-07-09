<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $Data['Title'] ?></title>

    
    <link rel="stylesheet" href="<?php echo _Root ?>static/css/layout.css">
    <link rel="stylesheet" href="<?php echo _Root ?>static/css/index.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.css">
  
</head>
<body>
<header class="container">
    <div class="profile">
        <div class="profile-image">
        <a href="http://sariab.ir">
		<img width="150" src="<?php echo _Root ?>logo/Icon.svg" alt="Sariab Logo">
        </a>
        </div>
        <div class="profile-user-settings">
            <h1 class="profile-user-name box-with-text">sariabbloggers</h1>
            <span class="profile-real-name"><strong>ساریاب</strong>
            گردآوری و اشتراک دانش و تجربه؛ و ایجاد انگیزه.</span>
        </div>
        <div class="searchbox-container">
            <form class="searchbox" method="GET" action="index.php" >
                <input  class="search-txt" type="text" name="q" placeholder="جستجو...">
                    <button type="submit" class="search-btn" >
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
            </form>
        </div>
        <div class="contribute-links">
            <a class="profile-edit-btn" href="http://kouy.ir/sariabcontent">ارسال مطلب یا دیدگاه</a>
            <a class="profile-edit-btn" href="<?php echo _Root ?>Home/Positions">همکاری با ما</a>
        </div>
        <div class="social-button">
            <a href="https://instagram.com/sariabbloggers" class="icon insta">
                <span>اینستاگرام</span>
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://t.me/sariabbloggers"class="icon tel">
                <span>تلگرام</span> 
                <i class="fab fa-telegram"></i>
            </a>
            <a href="https://github.com/Pressz/Sariab-V2"class="icon git">
                <span>متن باز</span>
                <i class="fab fa-github"></i>
            </a>
            <a href="https://vrgl.ir/D2lo5"class="icon faq">
                <span>سوالات پرتکرار (FAQ)</span>
                <i class="fa fa-question"></i>
            </a>
            <a href="<?php echo _Root ?>Home/ThankYou"class="icon heart">
                <span>قدردانی</span>
                <i class="fa fa-heart"></i>
            </a>
            <a href="<?php echo _Root ?>Home/RSS"class="icon rss">
                <span>خوراک</span>
                <i class="fa fa-rss"></i>
            </a>
        </div>
    </div>
    <!-- End of profile section -->
</header>

<main class="container">
<!--VIEW_CONTENT-->
</main>
</body>
</html>