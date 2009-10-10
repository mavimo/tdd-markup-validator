<?php include 'data.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Report di validazione</title>
    <link   type="text/css" rel="stylesheet" media="all" href="css/style.css" /> 
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
  </head>
  <body>
    <div id="header">
      <div id="validate-items"><span class="current">0</span>/<span class="tot"><?php print count($pages); ?></span></div>
      <div id="percentage"><span class="current">0</span>%</div>
      <h1>Report di validazione</h1>
      <div id="progressbar">
        <div class="valid"></div>
        <div class="warning"></div>
        <div class="error"></div>
        <div class="unaviable"></div>
        <!-- div style="width: 0%;"></div -->
      </div>
      <div id="filter">
        Visualizza: 
        <span class="all"> Tutti </span>
        <span class="valid"> Validi </span>
        <span class="warning"> Warning </span>
        <span class="error"> Error </span>
        <span class="unaviable"> Unvalid </span>
      </div>
    </div>
    <div id="content">
      <div id="report">
      <?php foreach($pages as $page) { ?>
        <div class="page to-parse">
          <div class="address">
            <div class="num-error"><a href="#"></a></div>
            <div class="num-warning"><a href="#"></a></div>
            <a href="<?php print $page; ?>"><?php print substr($page, 0, 75); ?></a>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
    <div id="footer">
    <?php print date('Y-m-d H:m'); ?>
    </div>
  </body>
</html>
