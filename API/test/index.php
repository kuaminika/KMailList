
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="js/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <style>
      .test-page
      {
        display:none;
      }
      .test-page.active{
        display: block;
      }
      .nav-link
      {
        cursor: pointer;
      }
    </style>
    <script>

      var hostUrl = "https://vps.cybereq.com/KuaminikaWorkspace/heartmindequation.com/KMailList/API/index.php";
    </script>
    <title>TEST_ KMAIL LIST</title>
</head>
<body>
<!-- Just an image -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">KMail List - API TESTS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <div class="nav-link" onclick="app.activateSection(this)" data-controller="selfAddTestController"  role="button"  >self add to list <span class="sr-only">(current)</span></div>
      </li>
      <li class="nav-item active">
        <div class="nav-link" onclick="app.activateSection(this)" data-controller="viewAllMailingListsController"   role="button" >View all lists</div>
      </li>
      <li class="nav-item">
        <div class="nav-link" >View all list members</div>
      </li>
    </ul>
  </div>
</nav>

<section id="selfAddTestController" class="active test-page"></section>
<section id="viewAllMailingListsController" class=" test-page"></section>

<script src="js/axios.min.js"        type="text/javascript"></script>
<script src="js/KLIBJS/KLIB.js"      type="text/javascript"></script>
<script src="js/KLIBJS/KForm.js"     type="text/javascript"></script>
<script src="js/KLIBJS/KCourrier.js" type="text/javascript"></script>
<script src="js/KLIBJS/KTemplate.js" type="text/javascript"></script>
<script src="js/KLIBJS/KClassTool.js" type="text/javascript"></script>

<script src="js/viewAllMailingListsController.js"></script>
<script src="js/selfAddTestController.js"></script>
<script src="js/app.js" type="text/javascript"></script>
   
</body>
</html>