<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $Data['Title'] ?></title>

    <link rel="stylesheet" href="<?php echo _Root ?>static/css/sariab.css">
    <link rel="stylesheet" href="<?php echo _Root ?>static/css/layout.css">
    <link rel="stylesheet" href="<?php echo _Root ?>static/css/view.css">

    <!-- Primary Meta Tags -->
    <meta name="title" content="<?php echo strip_tags($Data['Model']['Title']) ?>">
    <meta name="description" content="<?php echo strip_tags($Data['Model']['Abstract']) ?>">
    <meta name="keywords" content="<?php echo strip_tags($Data['Model']['Meta']) ?>" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo _Root ?>">
    <meta property="og:title" content="<?php echo strip_tags($Data['Model']['Title']) ?>">
    <meta property="og:description" content="<?php echo strip_tags($Data['Model']['Abstract']) ?>">
    <meta property="og:image" content="http://sariab.ir/image-generator.php?id=<?php echo $Data['Model']['Id'] ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo _Root ?>">
    <meta property="twitter:title" content="<?php echo strip_tags($Data['Model']['Title']) ?>">
    <meta property="twitter:description" content="<?php echo strip_tags($Data['Model']['Abstract']) ?>">
    <meta property="twitter:image" content="http://sariab.ir/image-generator.php?id=<?php echo $Data['Model']['Id'] ?>">

</head>
<body>

<main>

<div class="container background-white">

    <a class="border-rounded background-white color-dark"
    href="<?php echo _Root ?>#Posts">✖</a>

    <h1><?php echo $Data['Model']['Title'] ?></h1>
    <span><?php echo $Data['Model']['Publisher'] ?></span>
    <span><?php echo $Data['Model']['Submit'] ?></span>

    <p><?php echo $Data['Model']['Abstract'] ?></p>

    <a class="border-radius background-gold color-dark"
    href="<?php echo _Root . 'Home/Redirect/' .  $Data['Model']['Id'] ?>">
        مطالعه پست
    </a>

    <script>
    // Your application has indicated there's an error
    window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "<?php echo _Root . 'Home/Redirect/' .  $Data['Model']['Id'] ?>";

    }, 60000);
    </script>

</div>
<!-- End of container -->

</main>
</body>
</html>