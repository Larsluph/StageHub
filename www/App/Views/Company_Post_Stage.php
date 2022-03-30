<!DOCTYPE html>
<html lang="en">

<head>
  <title>StageHub - Post</title>
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
            - New offer -
          </div>
        </form>
        <hr class="separate mx-auto pt-1 col-9 mb-3 mt-4">
      </div>

      <div class="container col-3 rounded bg-white mt-5 mb-5">
        <div class="row">
          <div class="border-right">
          </div>
          <div class=" border-right">
            <div class="p-3 py-5">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Offer Settings</h4>
              </div>
              <form method = "POST" action = "/company/post">
                <div class="row mt-2">
                  <div class="col-md-12 mb-3">
                    <label class="labels">Offer name :</label>
                    <input name="offer_name" type="text" class="form-control" placeholder="Enter the name of the offer">
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="labels">Duration :</label>
                    <input name="duration" type="number" class="form-control" placeholder="Enter the duration of the offer">
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="labels">Location :</label>
                    <input name="location" type="text" class="form-control" placeholder="Enter the location of the offer">
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="labels">Salary (/h) :</label>
                    <input name="salary" type="text" class="form-control" placeholder="Enter the salary">
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="labels">Start date :</label>
                    <input name="start_date" type="number" class="form-control" placeholder="Enter the start date">
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="labels">Number of offers :</label>
                    <input name="number_of_offers" type="number" class="form-control" placeholder="Enter number of offers">
                  </div>
                  <input type="submit" onclick="document.location='/company/update'"
                    class="button-register px-4 mx-auto mt-5 mb-3" value="Post">
                </div>
              </form>
            </div>
            <div class="col-md-4">
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