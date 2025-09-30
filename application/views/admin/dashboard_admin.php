<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
    <?php $this->load->view('templates/sidebar'); ?>
        <?php $this->load->view('templates/navbar'); ?>

        <div class="main-panel">
            <div class="content-wrapper">


                <div class="row">
                    <div class="col-12">
                        <h1 class="h3 mb-4"><?= $title ?></h1>
                    </div>
                </div>

                <!-- Cartes de statistiques - CONTENU CENTRÉ -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white h-100">
                            <div class="card-body text-center">  <!-- Ajout de text-center -->
                                <div class="d-flex flex-column align-items-center">  <!-- Centrage vertical -->
                                    <div class="mb-3">  <!-- Marge en bas pour l'icône -->
                                        <i class="fas fa-users fa-3x"></i>  <!-- Icône agrandie -->
                                    </div>
                                    <div>
                                        <h2 class="mb-1"><?= $stats['total_etudiants'] ?></h2>  <!-- Taille augmentée -->
                                        <p class="mb-0">Étudiants total</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card bg-success text-white h-100">
                            <div class="card-body text-center">  <!-- Ajout de text-center -->
                                <div class="d-flex flex-column align-items-center">  <!-- Centrage vertical -->
                                    <div class="mb-3">  <!-- Marge en bas pour l'icône -->
                                        <i class="fas fa-user-check fa-3x"></i>  <!-- Icône agrandie -->
                                    </div>
                                    <div>
                                        <h2 class="mb-1"><?= $stats['connectes_aujourdhui'] ?></h2>  <!-- Taille augmentée -->
                                        <p class="mb-0">Connectés aujourd'hui</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card bg-info text-white h-100">
                            <div class="card-body text-center">  <!-- Ajout de text-center -->
                                <div class="d-flex flex-column align-items-center">  <!-- Centrage vertical -->
                                    <div class="mb-3">  <!-- Marge en bas pour l'icône -->
                                        <i class="fas fa-user-shield fa-3x"></i>  <!-- Icône agrandie -->
                                    </div>
                                    <div>
                                        <h4 class="mb-1">Admin</h4>  <!-- Taille adaptée -->
                                        <p class="mb-0"><?= $admin['NOM'] ?> <?= $admin['PRENOM'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dernières connexions -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-clock me-2"></i>Dernières connexions
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($stats['dernieres_connexions'])): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Étudiant</th>
                                                    <th>Date</th>
                                                    <th>Heure</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($stats['dernieres_connexions'] as $connexion): ?>
                                                <tr>
                                                    <td><?= $connexion['NOM'] ?> <?= $connexion['PRENOM'] ?></td>
                                                    <td><?= date('d/m/Y', strtotime($connexion['DATE'])) ?></td>
                                                    <td><?= $connexion['HEURE'] ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted">Aucune connexion récente</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>



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

