<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
    <?php $this->load->view('templates/sidebar'); ?>
        <?php $this->load->view('templates/navbar'); ?>

        <!-- Main Panel -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container-fluid">
                    
                    <!-- En-tête avec bouton retour -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h1 class="h3 mb-1"><?= $etudiant['PRENOM'] ?> <?= $etudiant['NOM'] ?></h1>
                                    <p class="text-muted mb-0">Détails de l'étudiant</p>
                                </div>
                                <a href="<?= site_url('etudiants_admin') ?>" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i>Retour à la liste
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Cartes d'information principales - ESPACEMENT CORRIGÉ -->
                    <div class="row mb-4">
                        <!-- Carte Identité -->
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-header bg-primary text-white py-3">
                                  <h5 class="card-title mb-0">
                                      <i class="mdi mdi-account-card-details me-4" style="margin-right: 1rem !important;"></i>Identité
                                  </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="40%"><strong>CNE:</strong></td>
                                            <td><?= $etudiant['CNE'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Massar:</strong></td>
                                            <td><?= $etudiant['C_MASSAR'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>CIN:</strong></td>
                                            <td><?= $etudiant['CIN'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Date naissance:</strong></td>
                                            <td><?= date('d/m/Y', strtotime($etudiant['DATE_NAIS'])) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sexe:</strong></td>
                                            <td><?= $etudiant['SEXE'] == 'M' ? 'Masculin' : 'Féminin' ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Carte Contact -->
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-header bg-info text-white py-3">
                                    <h5 class="card-title mb-0">
                                        <i class="mdi mdi-contact-mail me-3" style="margin-right: 1rem !important;"></i>Contact  <!-- me-3 pour espacement -->
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Email:</strong></td>
                                            <td><?= $etudiant['EMAIL'] ?: '<span class="text-muted">Non renseigné</span>' ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Téléphone:</strong></td>
                                            <td><?= $etudiant['TEL'] ?: '<span class="text-muted">Non renseigné</span>' ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Carte Autorisation -->
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-header bg-success text-white py-3">
                                    <h5 class="card-title mb-0">
                                        <i class="mdi mdi-check-circle me-3" style="margin-right: 1rem !important;"></i>Autorisation  <!-- me-3 pour espacement -->
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-left">  <!-- Alignement à gauche -->
                                        <?php if ($autorisation): ?>
                                            <div class="text-success mb-3 d-flex align-items-center">  <!-- Centrage icône -->
                                                <i class="mdi mdi-check-decagram fa-2x me-3"></i>  <!-- me-3 pour espacement -->
                                                <span><strong>Autorisé à se connecter</strong></span>
                                            </div>
                                            <p class="mb-0 ms-5">Filière: <strong><?= $autorisation['CODE_FIL'] ?></strong></p>  <!-- ms-5 pour marge -->
                                        <?php else: ?>
                                            <div class="text-danger mb-3 d-flex align-items-center">  <!-- Centrage icône -->
                                                <i class="mdi mdi-cancel fa-2x me-3"></i>  <!-- me-3 pour espacement -->
                                                <span><strong>Non autorisé</strong></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dernières connexions -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="mdi mdi-clock-outline me-3" style="margin-right: 1rem !important;"></i>Dernières connexions
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($connexions)): ?>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Heure</th>
                                                        <th>Type</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($connexions as $connexion): ?>
                                                    <tr>
                                                        <td><?= date('d/m/Y', strtotime($connexion['DATE'])) ?></td>
                                                        <td><?= $connexion['HEURE'] ?></td>
                                                        <td><span class="badge bg-success">Connexion</span></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-muted text-center py-3">Aucune connexion enregistrée</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <!-- Footer -->
            <?php $this->load->view('templates/footer'); ?>
