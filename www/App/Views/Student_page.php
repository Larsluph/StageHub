<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>StageHub</title>
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
    <button onclick="document.location.href='Profile_student_view.html';" class="profile float-end mx-lg-5 mt-5 fs-4" type="button">
      - PROFILE -
    </button>
    <button onclick="document.location.href='WhishList.html';" class="profile float-end mx-lg-5 mt-5 fs-4" type="button">
      - MY WHISHLIST -
    </button>
    <button onclick="document.location.href='Stage_view.html';" class="profile float-end mx-lg-5 mt-5 fs-4" type="button">
      - YOUR APPLICATIONS -
    </button>
  </div>
  <div class="search">
    <hr class="separate mx-auto pt-1 mb-4 mt-3 col-10">
    <form class="form text-center col-8 mx-auto mt-0">
      <input class="text_case col-5 px-4 pt-2 pb-2 fs-6 form-search" type="text" placeholder="Type of internship...">
      <input class="text_case col-4 px-4 pt-2 pb-2 fs-6 form-location" type="text" placeholder="Location...">
      <button type="submit" class="button-search px-4 pt-sm-1 pb-sm-1 fs-6">
        Search
      </button>
    </form>
    <hr class="separate mx-auto pt-1 col-9 mb-3 mt-4">
  </div>
  <div id="contenu">

    <div class="dashboard float-start col-2 pt-3 pb-2 ms-4 mt-0">
      <h5 class="col-2 position-absolute text-center">Filter</h5>
      <hr class="col-8 mx-auto mt-4">
      <table id="pagination" class="table_filter col-10 mx-auto table-striped table-bordered">
        <tr>
          <td>
            <div class="box d-flex">
              <select class="mx-auto col-12 fs-6 pt-1 pb-1" name="Level" id="Level_of_study_selected">
                <option value="none">Level of study</option>
                <option valeur="Bac">Bac</option>
                <option valeur="Bac+1">Bac+1</option>
                <option valeur="Bac+2">Bac+2</option>
                <option valeur="Bac+3">Bac+3</option>
                <option valeur="Bac+4">Bac+4</option>
                <option valeur="Bac+5">Bac+5</option>
                <option valeur="More">More</option>
              </select>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="box d-flex">
              <select class="mx-auto col-12 fs-6 pt-1 pb-1" name="Duration" id="Duration_selected">
                <option value="none">Duration</option>
                <option valeur="Less">Less</option>
                <option valeur="1_month">1 month</option>
                <option valeur="2_month">2 month</option>
                <option valeur="3_month">3 month</option>
                <option valeur="4_month">4 month</option>
                <option valeur="5_month">5 month</option>
                <option valeur="More">More</option>
              </select>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="box d-flex">
              <select class="mx-auto col-12 fs-6 pt-1 pb-1" name="Duration" id="Duration_selected">
                <option value="none">Minimum wage</option>
                <option valeur="3€/h">3€/h</option>
                <option valeur="4€/h">4€/h</option>
                <option valeur="5€/h">5€/h</option>
                <option valeur="6€/h">6€/h</option>
                <option valeur="7€/h">7€/h</option>
                <option valeur="More">More</option>
              </select>
            </div>
          </td>
        </tr>
      </table>
      <hr class="col-8 mx-auto">
    </div>
    <?php foreach ($notifications as $notifications ) { ?>
    <div class="dashboard float-end col-2 pt-3 pb-2 me-4 mt-0">
      <h5 class="col-2 position-absolute text-center">Notification</h5>
      <hr class="col-8 mx-auto mt-4">
      <div class="notification mx-auto col-10">
        <img alt="Logo_notif" class="mx-2 col-1 pt-1 pb-1 float-start" src="../assets/img/notif_ico.ico">
        <h4 class="fs-6 text-center pt-1 pe-2"><?php echo $notification['title'] ?></h4>
        <h6 class="fs-6 text-center"><?php echo $notification['content'] ?></h6>
      </div>
      <?php } ?>
      <hr class="col-8 mx-auto">
    </div>
    <div id="STAGE" class="col-7 mx-auto mt-2 mb-1">
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
                  <button onclick="document.location.href='Profile_company_view.html';" class="profile_company" type="button">
                    <h4 class="mt-4 fs-4 mx-5" value="Name_company"><?php echo $offre['nom_poste_offre'] ?></h4>
                  </button>
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
                  <input type="submit" href="#" class="button-register float-start ms-5 px-4 mx-auto mb-3" value="Apply">
                      <input type="submit" href="#" class="button-register float-start ms-1 px-4 mx-auto mb-3" value="Add to my WhishList">
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
      <a onclick="document.location='/terms'" type="button">Terms of use</a>
    </div>
  </footer>
</body>

</html>