<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>StageHub</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <div class="background--custom">
    <canvas id="canvas"></canvas>
  </div>

  <script src="../assets/js/background.js"></script>
  <script>
    var gradient = new Gradient();
    gradient.initGradient("#canvas");
  </script>
  <div id="header">
    <img alt="StageHub logo" class="col-2 mx-5 mt-2 mb-3" id="logo" src="../assets/img/logo_white_alpha.png"
      style="max-width: 300px;">
    <button class="profile float-end mx-lg-5 mt-5 fs-4" type="button">
      - PROFILE -
    </button>
    <button class="profile float-end mx-lg-5 mt-5 fs-4" type="button">
      - APPLICATIONS -
    </button>
    <button class="profile float-end mx-lg-5 mt-5 fs-4" type="button">
      - NEW POST -
    </button>
  </div>
  <div class="search">
    <hr class="separate mx-auto pt-1 mb-4 mt-3 col-10">
    <form class="form text-center col-8 mx-auto mt-0">
      <div class="Your_active_post text-center fs-4">
        - Your active post -
      </div>
    </form>
    <hr class="separate mx-auto pt-1 col-9 mb-3 mt-4">
  </div>
  <div id="contenu">
    <div class="dashboard float-start col-2 pt-3 pb-2 ms-4 mt-0">
      <h5 class="col-2 position-absolute text-center">Notification</h5>
      <hr class="col-8 mx-auto mt-4">
      <?php foreach ($notifications as $notification ) { ?>
      <div class="notification mt-1 mx-auto col-10">
        <img alt="Logo_notif" class="mx-2 col-1 pt-1 pb-1 float-start" src="../assets/img/notif_ico.ico">
        <h4 class="fs-6 text-center pt-1 pe-2"><?php echo $notification['title'] ?></h4>
        <h6 class="fs-6 text-center"><?php echo $notification['content'] ?></h6>
      </div>
      <?php } ?>
      <hr class="col-8 mx-auto">
    </div>
    <div id="STAGE" class="col-7 mx-auto mt-5 mb-1">
      <table id="pagination" class="table table-striped table-bordered w-100">
        <tbody>
          <tr>
            <td>
              <?php foreach ($offres as $offre) { ?>
              <div class="stage_offer d-flex mb-4">
                <img alt="Logo_company" class="Logo_company text-center align-self-center mx-4" id="logo"
                  src="../assets/img/cesi_logo.jpg">
                <div class="vr align-self-center"></div>
                <div style="padding-right: 45px;">
                  <h4 class="mt-4 fs-4 mx-5" value="Name_company"><?php echo $offre['nom_poste_offre'] ?></h4>
                  <hr class="col-3 mx-5 mb-4">
                  <table class="col-12 mt-4 mx-5 mb-4">
                    <tr>
                      <th>
                        <h5 class="fs-6 fw-bold" value="Description_stage">Quality required :</h4>
                          <hr class="col-4 mx-1 mb-1">
                      </th>
                      <th>
                        <h5 class="fs-6 fw-bold" value="Description_stage">Location :</h4>
                          <hr class="col-4 mx-1 mb-1">
                      </th>
                    </tr>
                    <td>
                      <h4 class="mt-3 fs-6 mx-auto" value="Name_company"><?php 
                        echo implode(" - ", explode("|", $offre['competences']));
                      ?>
                      </h4>
                    </td>
                    <td>
                      <h4 class="col-10 mt-3 fs-6" value="Name_company"><?php 
                        echo implode(" - ", explode("|", $offre['localites']));
                      ?>
                      </h4>
                    </td>
                  </table>
                  <input type="submit" href="#" class="button-register float-start ms-5 px-4 mx-auto mb-3" value="Modify">
                      
                </div>
              </div>
              <?php } ?>
            </td>
          </tr>
        </tbody>

      </table>


    </div>
  </div>

  <hr class="separate mx-auto pt-1 mb-4 mt-3 col-8">
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  </nav>
  <hr class="separate mx-auto pt-1 mb-4 mt-4 col-10">
  <footer class="col-12">


    <div class="Term-of-use-link text-center">
      <div class="copyright text-center p-3">
        © 2022 - StageHub /
      <a onclick="document.location='Terms_of_use.html'" type="button">Terms of use</a>
    </div>
  </footer>
</body>

</html>