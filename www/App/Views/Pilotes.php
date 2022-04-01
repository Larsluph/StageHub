<?php

use App\Pagination;

if (isset($_GET['page']))
    $page_nbr = $_GET['page'];
else
    $page_nbr = 1;

$pagination = new Pagination($page_nbr, $pilotes);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="List of tutors">
    <title>StageHub - Tutors</title>
    <link rel="stylesheet" href="/assets/css/style.css">
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
    <div id="header">
        <img alt="StageHub logo" class="col-2 mx-5 mt-2 mb-3" id="logo" src="/assets/img/logo_white_alpha.png" style="max-width: 300px;">
        <button onclick="document.location.href='/logout'" class="button-principal-tologin float-end pb-1 mx-lg-5 mt-4 fs-6" type="button">
            Logout
        </button>
        <button onclick="document.location.href='/pilotes/create';" class="profile float-end pt-1 mx-lg-5 mt-4 fs-6" type="button">
            - CREATE PILOTE -
        </button>


    </div>
    <div class="search">
        <hr class="separate mx-auto pt-1 mb-3 mt-1 col-10">
        <form class="form text-center col-8 mx-auto mt-0">
            <input name="tutor_name" class="text_case col-9 px-4 pt-2 pb-2 fs-6 form-search" type="text" placeholder="Tutor name...">
            <button type="submit" class="button-search px-4 pt-sm-1 pb-sm-1 fs-6">Search</button>
        </form>
        <hr class="separate mx-auto pt-1 col-9 mb-3 mt-3">
    </div>
    <div id="contenu">
        <div class="dashboard float-start col-2 pt-3 pb-2 ms-4 mt-0">
            <h5 class="col-2 position-absolute text-center">Notification</h5>
            <hr class="col-8 mx-auto mt-4">
            <?php foreach ($notifications as $notification) { ?>
                <div class="notification mx-auto col-10">
                    <img alt="Logo_notif" class="mx-2 col-1 pt-1 pb-1 float-start" src="/assets/img/notif_ico.ico">
                    <h4 class="fs-6 text-center pt-1 pe-2"><?php echo $notification['title'] ?></h4>
                    <h6 class="fs-6 text-center"> <?php echo $notification['content'] ?></h6>
                </div>
            <?php } ?>
            <hr class="col-8 mx-auto">
        </div>
        <div class="col-7 mx-auto mt-2 mb-1 stage">
            <table class="table table-striped table-bordered w-100">
                <tbody>
                    <tr>
                        <td>
                            <?php foreach ($pagination->get_page_items() as $tutor) { ?>
                                <div class="stage_offer d-flex mb-4">
                                    <div class="col-10 ms-5 table-center">
                                        <h4 class="float-end mt-4 fs-4"><?= $tutor['nom_promo'] ?></h4>
                                        <h4 class="mt-4 fs-4"><?= strtoupper($tutor['nom_user']) . ' ' . ucfirst($tutor['prenom_user']) ?></h4>

                                        <form method="get">
                                            <input formaction="/pilotes/<?= $tutor['id_user'] ?>/update" type="submit" class="button-register float-start ms-5 px-4 mx-auto mb-3" value="Modify">
                                            <input formaction="/pilotes/<?= $tutor['id_user'] ?>/delete" type="submit" class="button-delete float-start ms-1 px-4 mx-auto mb-3" value="Delete">
                                        </form>
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
    <?php $pagination->render() ?>
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