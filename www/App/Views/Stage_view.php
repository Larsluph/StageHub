<!DOCTYPE html>
<html lang="en">

<head>
    <title>StageHub - Terms of Use</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
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
            <div class="search">
                <hr class="separate mx-auto pt-1 mb-4 mt-3 col-10">
                <form class="form text-center col-8 mx-auto mt-0">
                  <div class="Your_active_post text-center fs-4">
                    - Your Applications -
                  </div>
                </form>
                <hr class="separate mx-auto pt-1 col-9 mb-3 mt-4">
              </div>
              <div class="stage_offer col-8 mx-auto d-flex mb-4">
                <img alt="Logo_company" class="Logo_company text-center align-self-center mx-4" id="logo"
                  src="../assets/img/cesi_logo.jpg">
                <div class="vr align-self-center"></div>
                <div style="padding-right: 45px;">
                    <button onclick="document.location.href='Profile_company_view.html';" class="profile_company" type="button">
                        <h4 class="mt-4 fs-4 mx-5" value="Name_company">Cesi - Engineer School</h4>
                      </button>
                      <div>
                          <input href="#" class="statut col-auto text-center float-end ms-2 ps-2 pe-2" value="SELECTED">
                          <h4 class="float-end mt-1 fs-6 fw-bold" value="Name_company">Statut :</h4>
                        </div>
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
                      <h4 class="mt-3 fs-6 mx-auto" value="Name_company">rigorous - autonomous - dynamic - team spirit -
                        motivated - creative
                      </h4>
                    </td>
                    <td>
                      <h4 class="col-10 mt-3 fs-6" value="Name_company">Lille</h4>
                    </td>
                  </table>
                  <input type="submit" href="#" class="button-register float-start ms-5 px-4 mx-auto mb-3" value="Delete">
                </div>
              </div>
              <div class="stage_offer col-8 mx-auto d-flex mb-4">
                <img alt="Logo_company" class="Logo_company text-center align-self-center mx-4" id="logo"
                  src="../assets/img/cesi_logo.jpg">
                <div class="vr align-self-center"></div>
                <div style="padding-right: 45px;">
                    <button onclick="document.location.href='Profile_company_view.html';" class="profile_company" type="button">
                        <h4 class="mt-4 fs-4 mx-5" value="Name_company">Cesi - Engineer School</h4>
                      </button>
                      <div>
                        <input href="#" class="statut col-auto text-center float-end ms-2 ps-2 pe-2" value=" NOT SELECTED">
                        <h4 class="float-end mt-1 fs-6 fw-bold" value="Name_company">Statut :</h4>
                      </div>
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
                      <h4 class="mt-3 fs-6 mx-auto" value="Name_company">rigorous - autonomous - dynamic - team spirit -
                        motivated - creative
                      </h4>
                    </td>
                    <td>
                      <h4 class="col-10 mt-3 fs-6" value="Name_company">Lille</h4>
                    </td>
                  </table>
                  <input type="submit" href="#" class="button-register float-start ms-5 px-4 mx-auto mb-3" value="Delete">
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