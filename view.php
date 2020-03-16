<?php

if(!$_GET['id']) {
    header('Location: index.php');
    exit; // TODO: Return 404
}

require_once 'config.pass.php';
require_once 'config.php';
$result= mysqli_query($conn, 
    "SELECT * FROM Posts WHERE Id = " . $_GET['id'] . " LIMIT 1"
);
$values = $result->fetch_array();

if ($values == null)
{
    header('Location: index.php');
    exit; // TODO: Return 404
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $values['Title'] ?></title>

    <link rel="stylesheet" href="static/css/layout.css">
    <link rel="stylesheet" href="static/css/view.css">

    <!-- Primary Meta Tags -->
    <meta name="title" content="<?php echo $values['Title'] ?>">
    <meta name="description" content="<?php echo $values['Abstract'] ?>">
    <meta name="keywords" content="<?php echo $values['Meta'] ?>" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://sariab.ir/">
    <meta property="og:title" content="<?php echo $values['Title'] ?>">
    <meta property="og:description" content="<?php echo $values['Abstract'] ?>">
    <meta property="og:image" content="http://sariab.ir/image-generator.php?id=<?php echo $values['Id'] ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="http://sariab.ir/">
    <meta property="twitter:title" content="<?php echo $values['Title'] ?>">
    <meta property="twitter:description" content="<?php echo $values['Abstract'] ?>">
    <meta property="twitter:image" content="http://sariab.ir/image-generator.php?id=<?php echo $values['Id'] ?>">

</head>
<body>
<header>

<div class="container">

    <div class="profile">

        <div class="profile-image">

            <img width="150" src="https://github.com/Pressz/Sariab-V2/blob/master/logo/Icon.png?raw=true" alt="Sariab Logo">

        </div>

        <div class="profile-user-settings">

            <h1 class="profile-user-name">sariabbloggers</h1>

            <a class="btn profile-edit-btn" href="http://kouy.ir/sariabcontent">ارسال محتوی</a>

            <button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>

        </div>

        <!-- <div class="profile-stats">

            <ul>
                <li><span class="profile-stat-count">164</span> posts</li>
                <li><span class="profile-stat-count">188</span> followers</li>
                <li><span class="profile-stat-count">206</span> following</li>
            </ul>

        </div> -->

        <div class="profile-bio">

            <p><span class="profile-real-name">ساریاب</span>
            ساریاب نام کوهی است که دانشگاه کوچکمان را در پناه آن ساخته اند</p>

        </div>

    </div>
    <!-- End of profile section -->

</div>
<!-- End of container -->

</header>

<main>

<div class="container">


    <div>
        <?php echo $values['Abstract'] ?>
    </div>

    <a class="push-btn" href="<?php echo $values['Canonical'] ?>">
        مطالعه پست
    </a>

    <script>

    // Your application has indicated there's an error
    window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "<?php echo $values['Canonical'] ?>";

    }, 5000);

    </script>


    <!-- <div class="loader"></div> -->

</div>
<!-- End of container -->

</main>
</body>
</html>