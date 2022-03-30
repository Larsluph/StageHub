<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>StageHub - Company</title>
  <link rel="stylesheet" href="/assets/css/style.css">
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
  <div id="header">
    <img alt="StageHub logo" class="col-2 mx-5 mt-2 mb-3" id="logo" src="/assets/img/logo_white_alpha.png"
      style="max-width: 300px;">
    <button onclick="document.location.href='/company/applications';" class="profile float-end mx-lg-5 mt-5 fs-4" type="button">
      - APPLICATIONS -
    </button>
    <button onclick="document.location.href='/company/post';" class="profile float-end mx-lg-5 mt-5 fs-4" type="button">
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

  <div class="col-12" id="contenu">
    <div class="dashboard float-start col-2 pt-3 pb-2 ms-4 mt-0">
      <h5 class="col-2 position-absolute text-center">Notification</h5>
      <hr class="col-8 mx-auto mt-4">
      <?php foreach ($notifications as $notification) { ?>
      <div class="notification mt-1 mx-auto col-10">
        <img alt="Logo_notif" class="mx-2 col-1 pt-1 pb-1 float-start" src="../assets/img/notif_ico.ico">
        <h4 class="fs-6 text-center pt-1 pe-2"><?php echo $notification['nom_poste_offre'] ?></h4>
        <h6 class="fs-6 text-center"><?php echo $notification['content'] ?></h6>
      </div>
      <?php } ?>
      <hr class="col-8 mx-auto mt-4">
    </div>

    <div class="col-12 mx-auto mt-5 mb-1 stage">
      <table class="col-7 float-start ms-5">
        <tbody>
          <tr>
            <td>
            <?php foreach ($offres as $offre) { ?> 
            <div class="stage_offer d-flex mb-4">
                <div class="col-10 ms-5 table-center">
                  <h4 class="mt-4 fs-4"><?php echo $offre['nom_poste_offre'] ?></h4>
                  <hr class="col-5 mx-5 mb-4">
                  <table class="col-12 mt-4 mx-5 mb-4">
                    <tr>
                      <th class="ms-5 fs-6 fw-bold">
                        Quality required :
                        <hr class="col-4 mx-1 mb-1">
                      </th>
                      <th class="fs-6 fw-bold">
                        Location :
                        <hr class="col-4 mx-1 mb-1">
                      </th>
                    </tr>
                    <tr>
                      <td class="ms-5 mt-3 fs-6 mx-auto">
                        <?php echo implode(" - ", explode("|", $offre['competences'])); ?>
                      </td>
                      <td>
                      <h4 class="col-10 mt-3 fs-6">
                        <?php echo implode(" - ", explode("|", $offre['localites'])); ?>
                      </h4>
                      </td>
                    </tr>
                  </table>
                  <input onclick="document.location.href='/company/update?id_offre=<?php echo $offre['id_offre'] ?> " type="submit" class="button-register float-start ms-5 px-4 mx-auto mb-3" value="Modify">
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
  <div class="text-center">
      <div class="copyright text-center p-3">
        © 2022 - StageHub /
        <a class="Term-of-use-link" href="/termsofuse">Terms of use</a>
      </div>
    </div>
  </footer>
</body>

</html>