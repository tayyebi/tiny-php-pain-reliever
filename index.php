<?php
require_once 'config.pass.php';
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sariab</title>

    <link rel="stylesheet" href="static/css/index.css">
</head>
<body>
<header>

<div class="container">

    <div class="profile">

        <div class="profile-image">

            <img width="150" src="https://github.com/Pressz/Sariab-V2/blob/master/logo/Icon2.png?raw=true" alt="Sariab Logo">

        </div>

        <div class="profile-user-settings">

            <h1 class="profile-user-name">sariabbloggers</h1>

            <a class="btn profile-edit-btn" href="http://kouy.ir/sariabcontent">ارسال مطلب یا دیدگاه</a>

            <button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>

        </div>

        <div class="profile-stats">

            <ul>
                <!-- <li>ایمیل<a href="mailto:info@sariab.ir" class="profile-stat-count">info@sariab.ir</a></li> -->
                <li>اینستاگرام<a href="https://instagram.com/sariabbloggers" class="profile-stat-count">@sariabblogers</a></li>
                <li>تلگرام<a href="https://t.me/sariabblogers" class="profile-stat-count">@sariabbloggers</a></li>
            </ul>

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
	<form class="searchbox" method="GET" action="index.php">
		<input type="text" name="q" />
		<input type="submit" value="🔎" />
	</form>
	<ul class="categories">
    <?php
    $select_keywords_query = "SELECT *
    FROM `Keywords`
    LIMIT 100";

    $result = $conn->query($select_keywords_query);

    while ($row = $result->fetch_assoc()) {
    ?>
    <li><a href="index.php?q=<?php echo $row['Title'] ?>"><?php echo $row['Title'] ?></a></li>
    <?php
    }
    ?>
    </ul>
    </div>
    <div class="gallery">

        <?php

        $search_query = "";
        if (isset($_GET['q']))
            $search_query = $_GET['q'];

        $select_posts_query = "SELECT *
        FROM `Posts`
        WHERE `Meta` LIKE '%$search_query%'
        OR `Title` LIKE '%$search_query%'
        ORDER BY `Submit` DESC
        LIMIT 100";

        $result = $conn->query($select_posts_query);

        while ($row = $result->fetch_assoc()) {

        ?>


        <a class="gallery-item" tabindex="0" href="<?php echo $row['Canonical'] ?>">

            <img src="image-generator.php?id=<?php echo $row['Id'] ?>" class="gallery-image" alt="<?php echo $row['Title'] ?>">

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
