<?php
die("Direct invocation isn't allowed.");
?>
<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favicon.ico">
    <title>ShitHub - {title}</title>

    <!-- Bootstrap core CSS -->

    <link href="libs/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><img src="img/logo.png">ShitHub</a>
      <button class="navbar-toggler" type="bootstraputton" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link {dashboard_active}" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {upload_active}" href="?site=upload">Upload <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown-review" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Review
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdown-review">
          <a class="dropdown-item" href="#">C</a>
          <a class="dropdown-item" href="#">C++</a>
          <a class="dropdown-item" href="#">C#</a>
          <a class="dropdown-item" href="#">PHP</a>
          <a class="dropdown-item" href="#">Java</a>
          <a class="dropdown-item" href="#">JavaScript</a>
          <a class="dropdown-item" href="#">Python</a>
        </div>
      </li>
          
        </ul>
        <ul class="navbar-nav navbar-right">
          <li class="nav-item">
            {loginor}
          </li>
          
        </ul>
      </div>
      
    </nav>
