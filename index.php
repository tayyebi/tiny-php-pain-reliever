<?php
require_once 'lib.php';
require_once 'config.pass.php';
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ساریاب</title>

    
    <link rel="stylesheet" href="static/css/layout.css">
    <link rel="stylesheet" href="static/css/index.css">
    <script src="https://use.fontawesome.com/feedb0380e.js"></script>
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

            <a class="btn profile-edit-btn" href="http://kouy.ir/sariabcontent">ارسال مطلب یا دیدگاه</a>
            <a class="btn profile-edit-btn" href="positions.php">همکاری با ما</a>

           <!-- <button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>-->

        </div>

        
        <div class="social-button">
                  <a href="https://instagram.com/sariabbloggers"><i class="fab fa-instagram"></i></a>
                  <a href="https://t.me/sariabbloggers"><i class="fab fa-telegram"></i></a>
                  <a href="https://github.com/Pressz/Sariab-V2"><i class="fab fa-github"></i></a>
                  <a href="http://vrgl.ir/32N6W"><i class="fa fa-question"></i></a>
                  <a href="thankyou.php"><i class="fa fa-heart"></i></a>
        </div>

        <div class="profile-bio">

            <p><span class="profile-real-name">ساریاب</span>
            گردآوری و اشتراک دانش و تجربه؛ و ایجاد انگیزه.
            </p>

        </div>

    </div>
    <!-- End of profile section -->

</div>
<!-- End of container -->

</header>

<main>

<div class="container">
    <div class="toolbar">


	<form class="searchbox" method="GET" action="index.php" >
        <input  class="search-txt" type="text" name="q" placeholder="جستجو...">
        <button type="submit" class="search-btn" >
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>
    </form>
    


	<ul class="categories" >
    <?php
    $select_keywords_query = "SELECT *
    FROM `Keywords`
    LIMIT 100";

    $result = $conn->query($select_keywords_query);

    while ($row = $result->fetch_assoc()) {
    ?>
    <li><a class="btn profile-edit-btn" href="index.php?q=<?php echo $row['Title'] ?>"><?php echo $row['Title'] ?></a></li>
    <?php
    }
    ?>
    </ul>
    </div>



    <div class="podcast">
    <?php
    $select_podcast_query = "SELECT *
    FROM `Podcasts`
    ORDER BY `Id` DESC
    LIMIT 1";
    $result = $conn->query($select_podcast_query);
    while ($row = $result->fetch_assoc()) {
    ?>
    <h1><?php echo $row['Title'] ?></h1>
    <h2><?php echo $row['PublishDate'] ?></h2>
    <audio controls preload="metadata" class="center">
        <!-- <source src="myfile.ogg" type="audio/ogg"> -->
        <source src="<?php echo $row['FileUrl'] ?>" type="audio/mpeg">
        مرورگر شما از پخش کننده‌ی صدا پشتیبانی نمی‌کند/
        <a href="<?php echo $row['FileUrl'] ?>">
        دانلود
        </a>
    </audio>
    <?php
    }
    ?>
    </div>




    <div class="gallery">

        <?php
        $search_query = "";
        if (isset($_GET['q']))
            $search_query = SuperLiteSql::injection_prevent($_GET['q']);

        $select_posts_query = "SELECT *
        FROM `Posts`
        WHERE `Meta` LIKE '%$search_query%'
        OR `Title` LIKE '%$search_query%'
        ORDER BY `Submit` DESC
        LIMIT 100";

        $result = $conn->query($select_posts_query);

        while ($row = $result->fetch_assoc()) {

        ?>
                <a class="gallery-item" tabindex="0" >
                <!--.card:hover>.gallery-item-front-->
                
                <div class="gallery-item card">
                              <div class="gallery-item-front ">
                                     <img src="image-generator.php?id=<?php echo $row['Id'] ?>" class="gallery-image" alt="<?php echo $row['Title'] ?>">
                                </div>
                                  <div class="gallery-item-back">
                                         <div class="gallery-item gallery-item-back-content ">
                                                   <h2><?php echo $row['Title'] ?></h2>
                                                   <span><?php echo $row['Abstract'] ?></span>
                                          </div>
                                     </div>
                 </div>

            <!-- <div class="gallery-item-info">

                <ul>
                    <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 56</li>
                    <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
                </ul>

            </div> -->

        </a>
        
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
