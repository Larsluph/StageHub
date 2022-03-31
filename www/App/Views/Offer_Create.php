<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StageHub - Post</title>
  <link rel="stylesheet" href="/assets/css/style.css" type="text/css">
  <link rel="manifest" href="/manifest.webmanifest">
  <script>
    //if browser support service worker
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('sw.js');
    }
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
            - New offer -
          </div>
        </form>
        <hr class="separate mx-auto pt-1 col-9 mb-3 mt-4">
      </div>

      <div class="container col-3 rounded bg-white mt-5 mb-5">
        <div class="row">
          <div class="border-right">
            <div class="p-3 py-5">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Offer Settings</h4>
              </div>
              <form method="POST">
                <input name="id_entreprise" type="hidden" value="<?php echo $offre['id_entreprise'] ?>">
                <div class="row mt-2">
                  <div class="col-md-12 mb-3">
                    <label class="labels" for="offer_name">Offer name :</label>
                    <input id="offer_name" name="offer_name" type="text" class="form-control" placeholder="Enter the name of the offer" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="labels" for="duration">Duration :</label>
                    <input id="duration" name="duration" type="number" class="form-control" placeholder="Enter the duration of the offer" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="labels" for="location">Location :</label>
                    <input id="location" name="location" type="text" class="form-control" placeholder="Enter the location of the offer" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="labels" for="salary">Salary (/h) :</label>
                    <input id="salary" name="salary" type="number" class="form-control" placeholder="Enter the salary" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="labels" for="skills">Skills :</label>
                    <input id="skills" name="skills" type="text" class="form-control" placeholder="Enter the competences of the offer" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="labels" for="start_date">Start date :</label>
                    <input id="start_date" name="start_date" type="date" class="form-control" placeholder="Enter the start date" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="labels" for="number_of_offers">Number of offers :</label>
                    <input id="number_of_offers" name="number_of_offers" type="number" class="form-control" placeholder="Enter the number of offers" required>
                  </div>
                  <input type="submit" class="button-register px-4 mx-auto mt-5 mb-3" value="Post">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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