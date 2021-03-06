<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Student applications">
  <title>StageHub - Applications</title>
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
            - Your Applications -
          </div>
        </form>
        <hr class="separate mx-auto pt-1 col-9 mb-3 mt-4">
      </div>
      <div class="stage_offer col-8 mx-auto d-flex mb-4">
        <img alt="Logo_company" class="Logo_company text-center align-self-center mx-4" src="/assets/img/cesi_logo.jpg">
        <div class="vr align-self-center"></div>
        <div style="padding-right: 45px;">
          <button onclick="document.location.href='/companies/profile';" class="profile_company mt-4 fs-4 mx-5" type="button">
            Cesi - Engineer School
          </button>
          <div>
            <input class="statut col-auto text-center float-end ms-2 ps-2 pe-2" value="SELECTED">
            <h4 class="float-end mt-1 fs-6 fw-bold">Statut :</h4>
          </div>
          <hr class="col-3 mx-5 mb-4">
          <table class="col-12 mt-4 mx-5 mb-4">
            <tr>
              <th class="fs-6 fw-bold">
                Quality required :
                <hr class="col-4 mx-1 mb-1">
              </th>
              <th class="fs-6 fw-bold">
                Location :
                <hr class="col-4 mx-1 mb-1">
              </th>
            </tr>
            <tr>
              <td class="mt-3 fs-6 mx-auto">
                rigorous - autonomous - dynamic - team spirit -
                motivated - creative
              </td>
              <td class="col-10 mt-3 fs-6">
                Lille
              </td>
            </tr>
          </table>
          <input type="submit" class="button-register float-start ms-5 px-4 mx-auto mb-3" value="Delete">
        </div>
      </div>
    </div>
  </div>
  <footer class="col-12">
    <div class="text-center">
      <div class="copyright text-center p-3">
        ?? 2022 - StageHub /
        <a class="Term-of-use-link" href="/termsofuse">Terms of use</a>
      </div>
    </div>
  </footer>
</body>

</html>