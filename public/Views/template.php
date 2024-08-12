<html>
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/template.css">
  <link rel="stylesheet" type="text/css" href="css/left-bar.css">
  <link rel="stylesheet" type="text/css" href="css/right-bar.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <link rel="stylesheet" type="text/css" href="css/search.css">
  <link rel="stylesheet" type="text/css" href="css/about.css">
  <link rel="stylesheet" type="text/css" href="css/services.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title><?=$this->e($title)?></title>
  </head>
  <body>  

  <div class="main-container">
  <aside>
        <?=$this->insert('includes/left-bar')?>
    </aside>

  <section>
    <?=$this->section('content')?>
  </section>

  <aside >
        <?=$this->insert('includes/right-bar')?>
    </aside>
  </div>

  </body>
</html>
