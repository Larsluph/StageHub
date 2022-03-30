<?php 
  use App\Pagination;
  if (isset($_GET['page']))
    $page_nbr = $_GET['page'];
  else
    $page_nbr = 1;
  $pagination = new Pagination($page_nbr, $candidatures);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StageHub - Applications</title>
    <link rel="stylesheet" href="/assets/css/style.css" type="text/css">
    <link rel="manifest" href="/manifest.webmanifest">
    <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker
                .register('/assets/js/sw.js')
                .then(registration => {
                  console.log(
                          `Service Worker enregistré ! Ressource: ${registration.scope}`
                  );
                })
                .catch(err => {
                  console.log(
                          `Echec de l'enregistrement du Service Worker: ${err}`
                  );
                });
      });
    }

    self.addEventListener('install', (e) => {
      console.log('[Service Worker] Install');
    });
    </script>
</head>

<body>
    <div class="background--custom">
        <canvas id="canvas"></canvas>
    </div>
    <script src="/assets/js/background.js"></script>
    <script>
        var gradient = new Gradient();
        gradient.initGradient("#canvas");
    </script>
    <div class="mx-5">
        <img onclick="history.back()" class="mx-5 mt-5" id="back_arrow" src="/assets/img/fleche.png" alt="Back to previous page">
        <img class="col-1 mx-auto mt-4 mb-3 d-block" id="logo" src="/assets/img/logo_white_alpha.png" alt="Logo">
    </div>
    <div class="col-auto mx-auto mt-5">
        <div class="main-body col-12">
            <div class="search">
                <hr class="separate mx-auto pt-1 mb-4 mt-3 col-10">
                <form class="form text-center col-8 mx-auto mt-0">
                    <div class="Your_active_post text-center fs-4">
                        - Company applications -
                    </div>
                </form>
                <hr class="separate mx-auto pt-1 col-9 mb-3 mt-4">
            </div>
            <div class="col-6 mx-auto mt-4">
            <?php foreach ($pagination->get_page_items() as $candidatures) { ?>
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-sm-5">
                                <h6 class="mb-0 ps-3">Full Name :</h6>
                            </div>
                            <div class="col-sm-7 text-secondary">
                                dfghtf
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-5">
                                <h6 class="mb-0 ps-3">Username :</h6>
                            </div>
                            <div class="col-sm-7 text-secondary">
                                gfjg
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-5">
                                <h6 class="mb-0 ps-3">Id :</h6>
                            </div>
                            <div class="col-sm-7 text-secondary">
                                gyjgyjername'] ?>
                            </div>
                        </div>
                        <hr>
                        <form>
                            <div class="answer">
                                <input type="radio" value="Validate" id="validate" name="answer" checked>
                                <label for="validate" class="radio">Validate</label>
                                <input type="radio" value="Refuse" id="refuse" name="answer">
                                <label for="refuse" class="radio">Refuse</label>
                            </div>
                            <input type="submit" class="button-register px-4 mx-auto mb-1" value="Submit">
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <hr class="separate mx-auto pt-1 mb-4 mt-3 col-8">
    <?php $pagination->render() ?>
    <hr class="separate mx-auto pt-1 mb-4 mt-4 col-10">
    <footer class="col-12">
        <div class="text-center">
            <div class="copyright text-center p-3">
                © 2022 - StageHub /
                <a class="Term-of-use-link" href="/termsofuse">Terms of use</a>
            </div>
        </div>
    </footer>
</body>

</html>