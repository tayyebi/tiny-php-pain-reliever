<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>tiny PHP PAIN RELIEVER</title>

    <link rel="canonical" href="<?php echo _Root?>">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo _Root ?>static/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo _Root ?>static/css/sariab.css" rel="stylesheet">
    <link href="<?php echo _Root ?>static/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><?php echo _AppName ?></a>
      <span class="form-control form-control-dark">
      <?php
        // Echos the page id and login
        echo isset($_GET['id']) ? $_GET['id'] : 'welcome';
        // echo " (u:" . $_COOKIE['Username'] . ")";
      ?>
      </span>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="<?php echo _Root ?>User/Logout">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo _Root ?>Admin">
                  <span data-feather="home"></span>
                  Dashbaord
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/TrustChain">
                  <span data-feather="link"></span>
                  Trust Chain
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/Statistics">
                  <span data-feather="pie-chart"></span>
                  Statistics
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/Files">
                  <span data-feather="folder"></span>
                  File Manager
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/Server">
                  <span data-feather="bar-chart-2"></span>
                  Server Resources
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Database</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <!-- <span data-feather="plus-circle"></span> -->
              </a>
            </h6>

            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/Items/Post">
                  <span data-feather="file"></span>
                  Posts (Authors, Verified)
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/Items/Post2">
                  <span data-feather="file"></span>
                  Posts (External Writers, Verified)
                </a>
              </li>
              <li>
                <a class="nav-link" href="<?php echo _Root ?>Admin/Items/Post3">
                  <span data-feather="file"></span>
                  Posts (Authors, Unverified)
                </a>
              </li>
              <li>
                <a class="nav-link" href="<?php echo _Root ?>Admin/Items/Post4">
                  <span data-feather="file"></span>
                  Posts (External Writer, Unverified)
                </a>
              </li>
              <li>
                <a class="nav-link" href="<?php echo _Root ?>Admin/Items/Feedback">
                  <span data-feather="mail"></span>
                  Feedbacks
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/Items/Roadmap">
                  <span data-feather="file"></span>
                  Roadmaps
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/Items/Road">
                  <span data-feather="file"></span>
                  Roads
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/Items/Keyword">
                  <span data-feather="file"></span>
                  Keywords
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/Items/Support">
                  <span data-feather="file"></span>
                  Support
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/Items/Podcast">
                  <span data-feather="file"></span>
                  Podcasts
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/Items/Position">
                  <span data-feather="file"></span>
                  Positions
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _Root ?>Admin/Items/Proclamation">
                  <span data-feather="file"></span>
                  Proclamations
                </a>
              </li>
            </ul>

          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
<!--VIEW_CONTENT-->
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- jQuery Plugin -->
    <script src="<?php echo _Root ?>static/js/jquery.slim.js"></script>
    <!-- Bootstrap Core JS -->
    <script src="<?php echo _Root ?>static/js/bootstrap.js"></script>
    <!-- Quill Editor -->
    <link href="<?php echo _Root ?>static/quill/quill.snow.1-3-6.css" rel="stylesheet">
    <script src="<?php echo _Root ?>static/quill/quill.min.1-3-6.js"></script>
    <script src="<?php echo _Root ?>static/quill/quill-textarea.js"></script>
    <script>
    $(document).ready(function() {
      // METHOD 1
      // var editor = new Quill('.html-editor'); // for divs

      // METHOD 2
      var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction

        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean'],                                         // remove formatting button

        ['image']
      ];


      (function() {
        quilljs_textarea('.html-editor', {
            modules: {
              toolbar: {
                  container: toolbarOptions,
                  handlers: {
                      image: function imageHandler() {
                          var range = this.quill.getSelection();
                          var value = prompt('What is the image URL');
                          if(value){
                              this.quill.insertEmbed(range.index, 'image', value, Quill.sources.USER);
                          }
                      }
                  }
              }
            },
            theme: 'snow',
            });
        })();
    });
    
    </script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace();
      $('#basicExampleModal.show').modal('show');
    </script>
  </body>
</html>