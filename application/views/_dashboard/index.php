<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);
?>
<!-- Header -->
<?php $this->load->view('templates/header'); ?>

<div class="container-scroller">

<!-- Sidebar -->
<?php $this->load->view('templates/sidebar'); ?>    
    
    <!-- Page Body Wrapper -->
    <div class="container-fluid page-body-wrapper">
    
<!-- Navbar -->
<?php $this->load->view('templates/navbar'); ?>
 

        <!-- Main Panel -->
        <div class="main-panel">
            <div class="content-wrapper">

                <!-- Ligne 1 : Infos personnelles & académiques -->
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Informations personnelles</h4>
                                <?php if (isset($etudiant) && is_array($etudiant)): ?>
                                    <p><strong>Nom : </strong><?= isset($etudiant['nom']) ? htmlspecialchars($etudiant['nom']) : '' ?> <?= isset($etudiant['prenom']) ? htmlspecialchars($etudiant['prenom']) : '' ?></p>
                                    <p><strong>CNE : </strong><?= isset($etudiant['CNE']) ? htmlspecialchars($etudiant['CNE']) : '' ?></p>
                                    <p><strong>CIN : </strong><?= isset($etudiant['motdepasse']) ? htmlspecialchars($etudiant['motdepasse']) : '' ?></p>
                                    <p><strong>Filière : </strong><?= isset($etudiant['CODE_FIL']) ? htmlspecialchars($etudiant['CODE_FIL']) : '' ?></p>
                                    <p><strong>Email : </strong><?= isset($etudiant['email']) ? htmlspecialchars($etudiant['email']) : '' ?></p>
                                    <p><strong>Téléphone : </strong><?= isset($etudiant['tel']) ? htmlspecialchars($etudiant['tel']) : '' ?></p>
                                <?php else: ?>
                                    <p>Aucune information disponible.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Informations académiques</h4>
                                <p><strong>Année universitaire : </strong><?= isset($annee_univ) ? htmlspecialchars($annee_univ) : '2024/2025' ?></p>
                                <p><strong>Semestre actuel : </strong><?= isset($this->session) && $this->session->userdata('semestre_actuel') ? htmlspecialchars($this->session->userdata('semestre_actuel')) : 'S1' ?></p>
                                <p><strong>Statut : </strong><span class="badge badge-success">Inscrit</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ligne 2 : Résumé rapide -->
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Résumé rapide</h4>
                                <ul>
                                    <li><strong>Mes Infos</strong> : Scolaires / Privées (menu)</li>
                                    <li><strong>Cursus</strong> : Modules et parcours (menu)</li>
                                    <li><strong>Inscription</strong> : Réinscription / Actuelle (menu)</li>
                                    <li><strong>Examens</strong> : Convocation / Résultat / Réclamation (menu)</li>
                                    <li><strong>Lois</strong> : Inscription / Évaluation / Cahier des normes (menu)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Footer -->
            <?php $this->load->view('templates/footer'); ?>
            
        </div>
        <!-- main-panel ends -->

    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller ends -->

<!-- JS principal -->
<?php $this->load->view('templates/js'); ?>

</body>
</html>
