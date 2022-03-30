<!DOCTYPE html>
<html lang="en">

<head>
  <title>StageHub - Applications</title>
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
            - Student apply -
          </div>
        </form>
        <hr class="separate mx-auto pt-1 col-9 mb-3 mt-4">
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