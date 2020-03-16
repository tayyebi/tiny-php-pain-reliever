
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>tiny PHP PAIN RELIEVER</title>

    <link rel="canonical" href="http://owerofthisdomain.ir">

    <!-- Bootstrap core CSS -->
    <link href="static/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="static/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
      <span class="form-control form-control-dark">
      <?php
        // Echos the page id and login
        echo isset($_GET['id']) ? $_GET['id'] : 'welcome';
        echo " (u:" . $_SERVER['PHP_AUTH_USER'] . ")";
      ?>
      </span>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Dashbaord
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin.php?id=superlitesql">
                  <span data-feather="code"></span>
                  SuperLiteSQL
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin.php?id=crud">
                  <span data-feather="file"></span>
                  Items
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="tinyfilemanager.php">
                  <span data-feather="folder"></span>
                  File Manager
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin.php?id=users">
                  <span data-feather="users"></span>
                  Users
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin.php?id=server">
                  <span data-feather="bar-chart-2"></span>
                  Server Resources
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>

            <ul class="nav flex-column mb-2"><?php
              $vowels = array("Classic Report", "-", ".sql"); //TODO: replace item check
              if ($handle = opendir('./reports')) {
                  while (false !== ($entry = readdir($handle))) {
                      if ($entry != "." && $entry != ".." && $entry != "filters") {
                          echo '<li class="nav-item">
                          <a class="nav-link" href="admin.php?id=superlitesql&entry=' . $entry . '">
                            <span data-feather="file-text"></span>
                            ' . $entry . '
                          </a>
                        </li>';
                      }
                  }
                  closedir($handle);
              }
            ?></ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
