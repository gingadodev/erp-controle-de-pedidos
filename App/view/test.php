<?php
    
  use App\Helper\AlertHelper;  

?><!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo URL_CSS; ?>bootstrap.min.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo URL_CSS; ?>style.css" type="text/css" media="all" />

        <title>Test</title>
    </head>
<body>

<section class="jumbotron text-center">
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


<?php

   $txt = '' 
       . '<h1>Lorem</h1>'
       . '<p>lorem ipsum dolor sit <i>amet</i></p>'
       . '<p>lorem <b>ipsum</b> dolor sit amet</p>'
       . '<p>lorem ipsum <a href="#">dolor</a> sit amet</p>'
       . '';

   echo AlertHelper::success($txt);
   echo AlertHelper::warning($txt);
   echo AlertHelper::danger($txt);

?>


</div>

<script src="<?php echo URL_JS; ?>bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo URL_JS; ?>bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="<?php echo URL_JS; ?>custom.js" type="text/javascript"></script>

</body>
</html>
