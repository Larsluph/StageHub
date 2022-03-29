<!DOCTYPE html>
<html lang="en">

<head>
  <title>StageHub - Terms of Use</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/assets/css/style.css" type="text/css">
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
    <img onclick="history.back()" class="mx-5 mt-5" id="back_arrow" src="/assets/img/fleche.png"
      alt="Back to previous page">
    <img class="col-1 mx-auto mt-4 mb-3 d-block" id="logo" src="/assets/img/logo_white_alpha.png" alt="Logo">
  </div>

  <div class="col-auto mx-auto mt-5">
    <div class="main-body col-12">
      <div class="search">
        <hr class="separate mx-auto pt-1 mb-4 mt-3 col-10">
        <form class="form text-center col-8 mx-auto mt-0">
          <div class="Your_active_post text-center fs-4">
            - Your company -
          </div>
        </form>
        <hr class="separate mx-auto pt-1 col-9 mb-3 mt-4">
      </div>

      <div>
        <div class="col-6 mx-auto mt-3">
          <div class="card mb-3">
            <div class="card-body text-center">
              <div class="row">
                <div>
                  <img class="col-2" src="/assets/img/cesi_logo.jpg" alt="Logo entreprise">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-5">
                  <h6 class="mb-0 ps-3">Name :</h6>
                </div>
                <div class="col-sm-7 text-secondary">
                  Cesi - Engineer School
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-5">
                  <h6 class="mb-0 ps-3">Location :</h6>
                </div>
                <div class="col-sm-7 text-secondary">
                  Lille
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-5">
                  <h6 class="mb-0 ps-3">Activity sector :</h6>
                </div>
                <div class="col-sm-7 text-secondary">
                  Engineer School
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-5">
                  <h6 class="mb-0 ps-3">ID :</h6>
                </div>
                <div class="col-sm-7 text-secondary">
                  <?php echo $user['username'] ?>
                </div>
              </div>
              <input type="submit" onclick="document.location='Profile_company_update.html'"
                class="button-register px-4 mx-auto mt-5 mb-3" value="Modify">
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
        <a class="Term-of-use-link" href="/terms">Terms of use</a>
      </div>
    </div>
  </footer>
</body>

</html>