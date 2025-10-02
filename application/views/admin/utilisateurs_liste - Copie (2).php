<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Main Panel -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container-fluid">


<!-- Messages flash pour la liste -->
<!-- Messages avec Bootstrap 4 -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-circle-outline me-2"></i>
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-alert-circle-outline me-2"></i>
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

            
            <!-- En-tête -->
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0"><?= $title ?></h1>
                        <a href="<?= site_url('dashboard_admin') ?>" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left me-2"></i>Retour
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="row mb-4">
                <!-- <div class="col-md-3 mb-3"> -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center p-3">
                            <h4 class="mb-1"><?= $stats['total_utilisateurs'] ?></h4>
                            <p class="mb-0 large"><b>Total</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center p-3">
                            <h4 class="mb-1"><?= $stats['utilisateurs_actifs'] ?></h4>
                            <p class="mb-0 large"><b>Actifs</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center p-3">
                            <h4 class="mb-1"><?= $stats['super_admins'] ?></h4>
                            <p class="mb-0 large"><b>Super Admin</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center p-3">
                            <h4 class="mb-1"><?= $stats['guichets'] ?></h4>
                            <p class="mb-0 large"><b>Guichets</b></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bouton d'ajout -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Liste des utilisateurs</h5>
                        <a href="<?= site_url('admin/creer-utilisateur') ?>" class="btn btn-primary">
                            <i class="mdi mdi-account-plus me-2"></i>Nouvel utilisateur
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tableau des utilisateurs -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if (!empty($utilisateurs)): ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Login</th>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Email</th>
                                                <th>Rôle</th>
                                                <th>Statut</th>
                                                <th>Date création</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($utilisateurs as $utilisateur): ?>
                                            <tr>
                                                <td><?= $utilisateur['LOGIN'] ?></td>
                                                <td><?= $utilisateur['NOM'] ?></td>
                                                <td><?= $utilisateur['PRENOM'] ?></td>
                                                <td><?= $utilisateur['EMAIL'] ?: '<span class="text-muted">Non renseigné</span>' ?></td>
                                                <td>
                                                    <span class="badge 
                                                        <?= $utilisateur['ROLE'] == 'SUPER_ADMIN' ? 'bg-danger' : 
                                                           ($utilisateur['ROLE'] == 'ADMIN' ? 'bg-primary' : 'bg-info') ?>">
                                                        <?= $utilisateur['ROLE'] ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge 
                                                        <?= $utilisateur['STATUT'] == 'ACTIF' ? 'bg-success' : 'bg-secondary' ?>">
                                                        <?= $utilisateur['STATUT'] ?>
                                                    </span>
                                                </td>
                                                
                                                
                                                <td><?= date('d/m/Y', strtotime($utilisateur['DATE_CREATION'])) ?></td>
                                                
                                                <td>
                                                    <div class="btn-group">
                                                        <!-- Bouton Modifier -->
                                                        <a href="<?= site_url('admin/editer-utilisateur/' . $utilisateur['ID']) ?>" 
                                                           class="btn btn-sm btn-warning" title="Modifier">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <!-- Bouton Activation/Désactivation -->
                                                        <?php if ($utilisateur['STATUT'] == 'ACTIF'): ?>
                                                            <a href="<?= site_url('admin/changer-statut/' . $utilisateur['ID']) ?>" 
                                                               class="btn btn-sm btn-secondary" title="Désactiver"
                                                               onclick="return confirm('Êtes-vous sûr de vouloir désactiver cet utilisateur ?')">
                                                                <i class="mdi mdi-account-off"></i>
                                                            </a>
                                                        <?php else: ?>
                                                        
                                                            <a href="<?= site_url('admin/changer-statut/' . $utilisateur['ID']) ?>" 
                                                               class="btn btn-sm btn-success" title="Activer"
                                                               onclick="return confirm('Êtes-vous sûr de vouloir activer cet utilisateur ?')">
                                                                <i class="mdi mdi-account-check"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <?php if (!empty($pagination)): ?>
                                <div class="d-flex justify-content-center mt-4">
                                    <?= $pagination ?>
                                </div>
                                <?php endif; ?>

                            <?php else: ?>
                                <div class="text-center py-4">
                                    <i class="mdi mdi-account-multiple-off fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Aucun utilisateur trouvé</p>
                                    <a href="<?= site_url('utilisateurs_admin/creer') ?>" class="btn btn-primary">
                                        <i class="mdi mdi-account-plus me-2"></i>Créer le premier utilisateur
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer + fermeture de toutes les balises -->
    <?php $this->load->view('templates/footer'); ?>
    