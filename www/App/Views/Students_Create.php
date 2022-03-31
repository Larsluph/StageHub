<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StageHub - Post</title>
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
                        - New student -
                    </div>
                </form>
                <hr class="separate mx-auto pt-1 col-9 mb-3 mt-4">
            </div>

            <div class="container col-3 rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Student Settings</h4>
                            </div>
                            <form method="POST">
                                <div class="row mt-2">
                                    <div class="col-md-12 mb-3">
                                        <label class="labels" for="nom_user">Name :</label>
                                        <input id="nom_user" name="nom_user" type="text" class="form-control" placeholder="Enter the surname of the student" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="labels" for="prenom_user">First name :</label>
                                        <input id="prenom_user" name="prenom_user" type="text" class="form-control" placeholder="Enter the first name of the student" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="labels" for="username">Username :</label>
                                        <input id="username" name="username" type="text" class="form-control" placeholder="Enter the username (name.surname)" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="labels" for="nom_promo">Promotion name :</label>
                                        <input id="nom_promo" name="nom_promo" type="text" class="form-control" placeholder="Enter the promotion name" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="labels" for="password">Password :</label>
                                        <input id="password" name="password" type="password" class="form-control" placeholder="Enter the password" required>
                                    </div>
                                    <input type="submit" class="button-register px-4 mx-auto mt-5 mb-3" value="Post">
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
                    © 2022 - StageHub /
                    <a class="Term-of-use-link" href="/termsofuse">Terms of use</a>
                </div>
            </div>
        </footer>
</body>

</html>