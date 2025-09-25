<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connexion - Espace Étudiant</title>
    <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" />
    <style>
        body.auth.login-bg { background: linear-gradient(135deg, #1f1f2e 0%, #3c3c50 100%); }
        .card { border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.3); }
        .card-title { font-weight: 600; font-size: 1.5rem; }
        .enter-btn { font-weight: 600; }
        .login-logo { text-align: center; margin-bottom: 20px; }
        .login-logo img { max-width: 120px; }
        #login-message { text-align: center; margin-top: 10px; font-weight: bold; }
        .admin-login { text-align: center; margin-top: 15px; }
        .admin-login a { color: #fff; text-decoration: underline; }
    </style>
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <div class="login-logo">
                            <img src="<?= base_url('assets/images/logo.svg') ?>" alt="Logo">
                        </div>
                        <h3 class="card-title text-center mb-4">Connexion Étudiant</h3>
                        <form id="login-form" method="post">
                            <div class="form-group">
                                <label>CNE / MASSAR *</label>
                                <input type="text" id="username" name="username" class="form-control p_input" maxlength="13" placeholder="Code National Étudiant ou MASSAR" required>
                            </div>
                            <div class="form-group">
                                <label>CIN *</label>
                                <input type="password" id="password" name="password" class="form-control p_input" maxlength="8" placeholder="Carte Identité Nationale" required>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-block enter-btn">Connexion</button>
                            </div>

                            <!-- Message d'erreur affiché juste sous le bouton -->
                            <div id="login-message" class="text-danger font-weight-bold text-center mt-3"></div>

                            <!-- Lien pour les admins -->
                            <div class="admin-login">
                                <a href="<?= site_url('auth/admin') ?>">Connexion Administrateur</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
<script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
<script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
<script src="<?= base_url('assets/js/misc.js') ?>"></script>
<script src="<?= base_url('assets/js/login.js') ?>"></script>
</body>
</html>
