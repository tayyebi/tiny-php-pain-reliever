<link rel="stylesheet" href="<?php echo _Root ?>static/css/roadmap.css">

<div class="intro border-radius background-gold color-dark">
  <h1 class="h1"><?php echo $Data['Title'] ?></h1>

  <div class="font-large"><?php echo $Data['Road']['Abstract'] ?></div>
</div>

<div class="timeline background-dark color-white">
  <?php for($i = 0;$i < count($Data['Posts']);$i++) {  ?>
  <div class="item <?php echo $i % 2 == 0 ? 'left' : 'right' ?>" id="post_<?php echo $Data['Posts'][$i]['Id'] ?>">
    <div class="content background-white color-dark">
      <span class="font-xxlarge color-gold"><?php
      echo $i+1 . '/' . count($Data['Posts']);
      if (isset($_COOKIE['CLIENT_VIEW'])
        and strpos($_COOKIE['CLIENT_VIEW'], '<' . $Data['Posts'][$i]['Id'] . '>') !== false)
      {
        echo '<strong>✓</strong>';
      }
      ?></span>
      <a href="<?php echo _Root . 'Home/View/' . $Data['Posts'][$i]['Id'] . '/' . $Data['Road']['Id'] ?>"><h2><?php echo $Data['Posts'][$i]['Title'] ?></h2></a>
      <div class="abstract">
        <?php echo $Data['Posts'][$i]['Abstract'] ?>
      </div>
      <a class="border-radius background-gold color-dark button-small more" href="<?php echo _Root . 'Home/View/' . $Data['Posts'][$i]['Id'] . '/' . $Data['Road']['Id'] ?>">مطالعه</a>
    </div>
  </div>
  <?php } ?>
</div>