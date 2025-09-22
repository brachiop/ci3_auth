<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php //$this->load->view('templates/header', $data); ?>
<?php $this->load->view('templates/header'); ?>
<div class="container-scroller">
    <?php $this->load->view('templates/sidebar'); ?>

    <div class="container-fluid page-body-wrapper">
        <?php $this->load->view('templates/navbar'); ?>

        <div class="main-panel">
            <div class="content-wrapper">

                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Informations Administrateur</h4>
                                <?php if (!empty($admin) && is_array($admin)): ?>
                                    <p><span class="label">Nom : </span><span class="value"><?= htmlspecialchars($admin['NOM']) ?></span></p>
                                    <p><span class="label">Prénom : </span><span class="value"><?= htmlspecialchars($admin['PRENOM']) ?></span></p>
                                    <p><span class="label">Login : </span><span class="value"><?= htmlspecialchars($admin['LOGIN']) ?></span></p>
                                    <p><span class="label">Email : </span><span class="value"><?= htmlspecialchars($admin['EMAIL']) ?></span></p>
                                    <p><span class="label">Rôle : </span><span class="value"><?= htmlspecialchars($admin['ROLE']) ?></span></p>
                                <?php else: ?>
                                    <p>Aucune information disponible.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Autres blocs, par exemple statistiques ou résumé rapide -->
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Résumé rapide</h4>
                                <ul>
                                    <li><a href="<?= site_url('admin/users') ?>">Gérer les utilisateurs</a></li>
                                    <li><a href="<?= site_url('admin/etudiants') ?>">ETUDIANTS</a></li>
                                    <li><a href="<?= site_url('admin/inscription') ?>">Inscriptions</a></li>
                                    <li><a href="<?= site_url('admin/examens') ?>">Examens</a></li>
                                    <li><a href="<?= site_url('admin/lois') ?>">Lois & réglementation</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- content-wrapper -->

            <?php $this->load->view('templates/footer'); ?>
        </div> <!-- main-panel ends -->

    </div> <!-- page-body-wrapper -->
</div> <!-- container-scroller -->

<?php $this->load->view('templates/js'); ?>
