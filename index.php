<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>POC studio Toolkit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A robust suite of app and landing page templates by Medium Rare">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,400i,500" rel="stylesheet">
    <link href="assets/css/theme.css" rel="stylesheet" type="text/css" media="all" />
    <link href="assets/css/main.css" rel="stylesheet" type="text/css" media="all" />
    <script src="https://kit.fontawesome.com/aaaada0f86.js" crossorigin="anonymous"></script>

    <!-- Les favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


  </head>

  <?php 

  $filename = 'Outils-Grid view.csv';

  // The nested array to hold all the arrays
  $allthetools = []; 

  // Open the file for reading
  if (($h = fopen("{$filename}", "r")) !== FALSE) 
    {
      // Each line in the file is converted into an individual array that we call $data
      // The items of the array are comma separated
      while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
      {
        // just pushing the ones that have the 'published' column cheked 
        if ($data[7] == 'checked' && $h != 0) {
          // Each individual array is being pushed into the nested array
          $allthetools[] = $data;   
        }

      }
      
      // Close the file
      fclose($h);
    }

  $categories = [
    'App design',
    'Code et web',
    'Communication',
    'Couleur et identité',
    'Écriture et publication',
    'Facilitation et animation',
    'Image',
    'Gestion de connaissance',
    'Typo et polices'
  ];

  ?> 

  <body>
      <section class="pt-3">
        <div class="container">

          <div class="row">

            <!-- Colonne controle -->
            <div class="col-12 col-md-auto mb-5">
              <!-- mettre le search un jour 
              <form class="mb-4">
                <input class="form-control" placeholder="Search" type="text" name="search-table" />
              </form>
              -->

              <!-- Navigation hidden on mobile -->
              <div class="list-group d-none d-sm-block" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="featured" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Favoris <i class="fas fa-star ml-1"></i></a>
                <?php foreach ($categories as $link) : ?>
                  <a class="list-group-item list-group-item-action" id="<?= preg_replace('/\s/', '', $link); ?>" data-toggle="list" href="#list-profile" role="tab" aria-controls="<?= preg_replace('/\s/', '', $link); ?>"><?= $link ?></a>
                <?php endforeach ?>
                <!-- Intégrer un dropdown pour le menu en mobile -->
              </div>

              <!-- nav mobile dropdown --> 
              <div id="dropdown" class="dropdown d-block d-sm-none">
                <button class="btn btn-primary btn-block btn-lg dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Choisir catégorie  
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <a href="" id="featured" data-toggle="list" class="dropdown-item" type="button">Favoris <i class="fas fa-star ml-1"></i></a>
                  <?php foreach ($categories as $link) : ?>
                    <a href="" id="<?= preg_replace('/\s/', '', $link); ?>" data-toggle="list" class="dropdown-item" type="button"><?= $link ?></a>
                  <?php endforeach ?>
                </div>
              </div>

              <!-- bouton contribuer -->
              <a href="https://airtable.com/shryiSXgHFVXPjMP3" class="mt-3 btn btn-warning btn-lg btn-block" target="_blank">Contribuer</a>

              <!-- logo POC studio caché sur mobile -->
              <a href="http://pocstudio.fr" class="d-none d-sm-block">
                <img src="assets/img/logo_poc_studio.svg" class="img-fluid mt-2 p-1">
              </a>

            </div>
            <!--end of col-->


            <!-- colonne contenu -->
            <div class="col">
              <div class="card card-sm">
                <div class="card-header d-flex bg-secondary justify-content-between align-items-center">
                  <div>
                    <h6 id="title">Favoris</h6>
                  </div>
                  <div>
                    <h6 id="count"></h6>
                  </div>
                  <!-- 
                  <form class="d-flex align-items-center">
                    <span class="mr-2 text-muted text-small text-nowrap">Sort by:</span>
                    <select class="custom-select">
                      <option value="alpha">Alphabetical</option>
                      <option value="old-new" selected>Newest</option>
                      <option value="new-old">Popular</option>
                      <option value="recent">Recently Updated</option>
                    </select>
                  </form>
                  -->
                </div>

                <ul id="tools" class="list-group list-group-flush">
                  <!-- Liste de tous les outils -->
                  <?php foreach ($allthetools as $tool) : ?>
                    <?php 
                      $title = $tool[0]; // titre
                      $thelink = $tool[1]; // le lien du projet
                      $baseline = $tool[2]; // la description 
                      $difficulty = $tool[3]; // la difficulté (chiffre de 1 à 5)
                      if ($tool[4] == 'checked') {
                        $isfeatured = true;
                      } else {
                        $isfeatured = false;
                      };
                      $url = preg_match('#\((.*?)\)#', $tool[5], $match); // sniffer l'url dans la case 
                      $url = $match[1]; 
                      $types = preg_split("/[\s,]+/" , $tool[6]); // les typologies transformées en array
                      $thecats = preg_split("/[\s,]+/" , preg_replace('/\s/', '', $tool[8])); // les catégories
                      // chceck if opensource 
                      if ($tool[9] == 'checked') {
                        $opensource = true;
                      } else {
                        $opensource = false;
                      };

                     ?>

                    <?php if ($isfeatured == 'true') : ?> 
                      <?php $class = 'featured' ?>
                    <?php endif ?>

                    <li class="list-group-item tool <?= $class ?> <?php foreach ($thecats as $thecat) {
                        echo $thecat;
                      } ?> ">
                      <?php $class = '' ?>
                      <div class="media align-items-center">
                        <a href="<?= $thelink ?>" class="mr-4 d-none d-sm-block">
                          <?php if ($url != '') : ?>  
                            <img alt="Logo <?= $title ?>" src="<?= $url ?>" class="rounded avatar avatar-lg" />
                          <?php else : ?>
                            <img alt="Logo <?= $title ?>" src="assets/img/orange_sq.jpg" class="rounded avatar avatar-lg" />
                          <?php endif ?>
                        </a>
                        <div class="media-body">
                          <div class="d-flex justify-content-between mb-2">
                            <div>
                              <a href="<?= $tool[1] ?>" class="mb-1" target="_blank">
                                <h4><?= $title ?> 
                                  <!-- check if featured -->
                                  <?php if ($tool[4] == 'checked') : ?> 
                                    <i class="ml-1 fas fa-star"></i>  
                                  <?php endif ?>
                                  <i class="ml-1 fad fa-external-link"></i>
                                </h4>
                              </a>
                              <span><?= $baseline ?></span>
                            </div>
                            <!-- 
                            <div class="dropdown">
                              <button class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-no-arrow" type="button" id="SidekickButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-dots-three-horizontal"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="SidekickButton">
                                <a class="dropdown-item" href="#">Save</a>
                                <a class="dropdown-item" href="#">Share</a>
                                <a class="dropdown-item" href="#">Comment</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Report</a>
                              </div>
                            </div>
                            -->
                          </div>
                          <h5>
                          <?php foreach ($types as $type) : ?>
                            <a class="badge badge-secondary badge-pill mb-2 <?= preg_split("/[\s,()]+/" , $type)[0] ?>" href="#"><?= $type ?></a>
                          <?php endforeach ?>
                          <?php if ($opensource == 'true') : ?>
                            <a href="#" class="badge badge-pill badge-dark mb-2 opensource"><i class="fab fa-osi mr-1"></i>Opensource</a>
                          <?php endif ?>
                        </h5>
                          <!-- icones en bas de présentation 
                          <div class="text-small">
                            <ul class="list-inline">
                              <li class="list-inline-item"><i class="icon-heart"></i> 221</li>
                              <li class="list-inline-item"><i class="icon-message"></i> 14</li>
                            </ul>
                          </div>
                          -->
                        </div>
                      </div>
                    </li>
                  <?php endforeach ?>
                  <!-- end of each tool-->

                </ul>
              </div>

              <!-- logo POC studio visible sur mobile -->
              <a href="http://pocstudio.fr" class="d-block d-sm-none">
                <img src="assets/img/logo_poc_studio.svg" class="img-fluid mt-2 p-1">
              </a>

            </div>
            <!-- end of col -->
            
          </div>
          <!--end of row-->
        </div>
        <!--end of container-->
      </section>
      <!--end of section-->


      <footer class="footer-short">
        
        <div class="container">
          <!-- 
          <nav class="row justify-content-between align-items-center">
            <div class="col-auto">
              <ul class="list-inline">
                <li class="list-inline-item">
                  <a href="#">
                    <img alt="Image" src="assets/img/logo-gray.svg" />
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">Overview</a>
                </li>
                <li class="list-inline-item">
                  <a href="#">Documentation</a>
                </li>
                <li class="list-inline-item">
                  <a href="#">Changelog</a>
                </li>
              </ul>
            </div>
            -->
            <!--end of col-->
            <div class="col-auto text-sm-right">
              <ul class="list-inline">
                <li class="list-inline-item">
                  <a href="https://github.com/tart2000/csv_toolkit" target="_blank"><i class="fab fa-github"></i></a>
                </li>
                <li class="list-inline-item">
                  <a href="http://twitter.com/tart2000" target="_blank"><i class="fab fa-twitter"></i></a>
                </li>
                <li class="list-inline-item">
                  <a href="http://pocstudio.fr" target="_blank">POC studio</a>
                </li>
              </ul>
            </div>
            <!--end of col-->
          </nav>
          <!--end of row-->
        </div>
        <!--end of container-->
      </footer>
    </div>

    <!-- Required vendor scripts (Do not remove) -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>

    <!-- Optional Vendor Scripts (Remove the plugin script here and comment initializer script out of index.js if site does not use that feature) -->

    <!-- Required theme scripts (Do not remove) -->
    <script type="text/javascript" src="assets/js/theme.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

  </body>

</html>
