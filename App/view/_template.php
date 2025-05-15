<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo URL_CSS; ?>bootstrap.min.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo URL_CSS; ?>style.css" type="text/css" media="all" />

        <title><?php echo $title; ?></title>
    </head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
  <a class="navbar-brand" href="#">Navbar w/ text</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
    </ul>
    <span class="navbar-text">
      Navbar text with an inline element
    </span>
  </div>
</div>
</nav>


<section class="jumbotron">
        <div class="container">
          <h1 class="jumbotron-heading">Example</h1>
          <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
          <p>
            <a href="#" class="btn btn-primary my-2">Main call to action</a>
            <a href="#" class="btn btn-secondary my-2">Secondary action</a>
          </p>
        </div>
</section>

<div class="container">

<?php $view->render($content, $data); ?>

<script src="<?php echo URL_JS; ?>bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo URL_JS; ?>bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="<?php echo URL_JS; ?>custom.js" type="text/javascript"></script>

</body>
</html>
