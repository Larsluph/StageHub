<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Student profile">
  <title>StageHub - Student profile</title>
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
      <div>
        <div class="col-6 mx-auto mt-3">
          <div class="card mb-3">
            <div class="card-body text-center">
              <div class="row">
                <div class="col-sm-5">
                  <h6 class="mb-0 ps-3">Full Name :</h6>
                </div>
                <div class="col-sm-7 text-secondary">
                  <?php echo $user['id_user'] ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-5">
                  <h6 class="mb-0 ps-3">Username :</h6>
                </div>
                <div class="col-sm-7 text-secondary">
                  <?php echo $user['nom_user'] . " " . $user['prenom_user'] ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-5">
                  <h6 class="mb-0 ps-3">Id :</h6>
                </div>
                <div class="col-sm-7 text-secondary">
                  <?php echo $user['username'] ?>
                </div>
              </div>
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