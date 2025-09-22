<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f5f5f5;
        }
        .login-container {
            margin-top: 80px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .card-header {
            background: #007bff;
            color: white;
            font-weight: bold;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">
                    Espace de Connexion
                </div>
                <div class="card-body">

                    <!-- Onglets -->
                    <ul class="nav nav-tabs" id="loginTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="student-tab" data-toggle="tab" href="#student" role="tab">Étudiant</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab">Admin / Gestionnaire</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3">
                        <!-- Connexion Étudiant -->
                        <div class="tab-pane fade show active" id="student" role="tabpanel">
                            <form method="post" action="<?= site_url('auth/login_student'); ?>">
                                <div class="form-group">
                                    <label for="identifier">CNE ou C-MASSAR</label>
                                    <input type="text" name="identifier" id="identifier" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Connexion Étudiant</button>
                            </form>
                        </div>

                        <!-- Connexion Admin -->
                        <div class="tab-pane fade" id="admin" role="tabpanel">
                            <form method="post" action="<?= site_url('auth/login_admin'); ?>">
                                <div class="form-group">
                                    <label for="login">Identifiant</label>
                                    <input type="text" name="login" id="login" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">Connexion Admin</button>
                            </form>
                        </div>
                    </div>

                    <!-- Message d’erreur -->
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="error-message">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
