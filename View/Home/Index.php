<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ساریاب</title>

    
    <link rel="stylesheet" href="static/css/layout.css">
    <link rel="stylesheet" href="static/css/index.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.css">
  
</head>
<body>
<header>

<div class="container">

    <div class="profile">

        <div class="profile-image">
        <a href="http://sariab.ir">
		<img width="150" src="logo/Icon.svg" alt="Sariab Logo">
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
                <a href="http://vrgl.ir/32N6W"class="icon faq">
                        <span>سوالات پرتکرار (FAQ)</span>
                        <i class="fa fa-question"></i>
                </a>
                <a href="Home/ThankYou"class="icon heart">
                        <span>قدردانی</span>
                        <i class="fa fa-heart"></i>
                </a>
        </div>

        
        <div class="contribute-links">
            <a class="profile-edit-btn" href="http://kouy.ir/sariabcontent">ارسال مطلب یا دیدگاه</a>
            <a class="profile-edit-btn" href="Home/Positions">همکاری با ما</a>
        </div>
 

    

    </div>
    <!-- End of profile section -->

</div>
<!-- End of container -->

</header>

<main>

<div class="container">

	<ul class="categories" >
    <?php
    // $select_keywords_query = "SELECT *
    // FROM `Keywords`
    // LIMIT 100";

    // $result = $conn->query($select_keywords_query);

    while (0) {
    ?>
    <li><a class="btn profile-edit-btn" href="index.php?q=<?php echo $item['Title'] ?>"><?php echo $item['Title'] ?></a></li>
    <?php
    }
    ?>
    </ul>



    <div class="podcast">
    <?php
    // $select_podcast_query = "SELECT *
    // FROM `Podcasts`
    // ORDER BY `Id` DESC
    // LIMIT 1";
    // $result = $conn->query($select_podcast_query);
    while (0) {
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




    <div class="gallery">

        <?php

        foreach ($Data['Models']['Posts'] as $item) {
        ?>
                <div class="gallery-item" tabindex="0" >
               
                
                <div class="gallery-item card">
                              <div class="gallery-item-front ">
                                     <img src="image-generator.php?id=<?php echo $item['Id'] ?>" class="gallery-image" alt="<?php echo $item['Title'] ?>">
                                </div>
                                  <div class="gallery-item-back">
                                         <div class="gallery-item-back-content ">
                                                   <h2 class="titles"><?php echo $item['Title'] ?></h2>
                                                   <span class="Paragraf"><?php
                                                   $AllowedCharsLimit = 30;
                                                   if(strlen($item['Abstract']) > $AllowedCharsLimit)
                                                     echo substr($item['Abstract'], 0, $AllowedCharsLimit)."...";
                                                   else
                                                     echo $item['Abstract'];
                                                     ?></span>

                                                   <a href="view.php?id=<?php echo $item['Id'] ?>" class="buttons"><span>بیشتر بدانید</span></a>
                                          </div>
                                     </div>
                 </div>

            <!-- <div class="gallery-item-info">

                <ul>
                    <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 56</li>
                    <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
                </ul>

            </div> -->

                </div>
        
        <?php
        }
        ?>

    </div>
    <!-- End of gallery -->

    <!-- <div class="loader"></div> -->

</div>
<!-- End of container -->

</main>
</body>
</html>
