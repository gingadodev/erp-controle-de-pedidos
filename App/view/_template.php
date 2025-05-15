<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo URL_CSS; ?>bootstrap.min.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo URL_CSS; ?>style.css" type="text/css" media="all" />

        <title><?php echo (!isset($title))? 'Mini_ERP': $title; ?></title>
    </head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
    <span class="navbar-text" style="color: #fff">
      Mini_ERP
    </span>
  <div class="collapse navbar-collapse container-fluid d-flex" id="navbarText">
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URL_BASE; ?>?c=produto">Produto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URL_BASE; ?>?c=carrinho">Carrinho</a>
      </li>
    </ul>
  </div>
</div>
</nav>



<?php $view->render($content, $data); ?>

<script src="<?php echo URL_JS; ?>bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo URL_JS; ?>bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="<?php echo URL_JS; ?>jquery.min.js" type="text/javascript"></script>
<script src="<?php echo URL_JS; ?>jquery.mask.min.js" type="text/javascript"></script>
<script src="<?php echo URL_JS; ?>custom.js" type="text/javascript"></script>

</body>
</html>
