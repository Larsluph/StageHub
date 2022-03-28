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
        <img onclick="history.back()" type="submit" class="mx-5 mt-5" id="back_arrow" src="/assets/img/fleche.png"
            alt="Back to previous page">
        <img class="col-1 mx-auto mt-4 mb-3 d-block" id="logo" src="/assets/img/logo_white_alpha.png">
    </div>

    <div class="col-auto mx-auto mt-5">
        <div class="main-body col-12">
        
              <div>
                <div class="col-6 mx-auto mt-3">
                  <div class="card mb-3">
                    <div class="card-body text-center">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0 ps-3">ID :</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">
                          <?php echo $user['id_user'] ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0 ps-3">Full Name :</h6>
                        </div>               
                        <div class="col-sm-7 text-secondary">
                          <?php echo $user['nom_user']." ".$user['prenom_user'] ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0 ps-3">Username :</h6>
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


          <div class="Term-of-use-link text-center">
            <div class="copyright text-center p-3">
              © 2022 - StageHub /
            <a onclick="document.location='/terms'" type="button">Terms of use</a>
          </div>
        </footer>
</body>

</html>