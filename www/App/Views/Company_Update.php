<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Update company">
    <title>StageHub - Update company</title>
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
                    - Update company -
                </div>
            </form>
            <hr class="separate mx-auto pt-1 col-9 mb-3 mt-4">
        </div>

        <div class="container col-3 rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Company</h4>
                        </div>
                        <form method="POST">
                            <input type="hidden" name="id_entreprise" value="<?= $entreprise['id_entreprise'] ?>">
                            <div class="row mt-2">
                                <div class="col-md-12 mb-3">
                                    <label class="labels" for="nom_entreprise">Company name :</label>
                                    <input id="nom_entreprise" name="nom_entreprise" type="text" value="<?= $entreprise['nom_entreprise'] ?>" class="form-control" placeholder="Enter the name of the company" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="labels" for="localites">Locations :</label>
                                    <input id="localites" name="localites" type="text" value="<?= implode('|', $entreprise['localites']) ?>" class="form-control" placeholder="Enter the locations of the company" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="labels" for="secteurs">Business areas :</label>
                                    <input id="secteurs" name="secteurs" type="text" value="<?= implode('|', $entreprise['secteurs_activite']) ?>" class="form-control" placeholder="Enter the business areas of the company" required>
                                </div>
                                <input type="submit" class="button-register px-4 mx-auto mt-5 mb-3" value="Update">
                            </div>
                        </form>
                    </div>
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