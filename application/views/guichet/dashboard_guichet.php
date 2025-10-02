<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
    <?php $this->load->view('templates/sidebar'); ?>
        <?php $this->load->view('templates/navbar'); ?>
        
        <!-- Main Panel -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container-fluid">
                    
                    <!-- En-tête -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h1 class="h3 mb-0"><?= $title ?></h1>
                                <span class="badge bg-info fs-6">GUICHET</span>
                            </div>
                        </div>
                    </div>

                    <!-- Message de bienvenue -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <h4 class="text-primary">Bienvenue, <?= $user['prenom'] ?> <?= $user['nom'] ?> !</h4>
                                    <!-- <p class="mb-0">Vous êtes connecté en tant que <strong>Opérateur de Guichet</strong>.</p> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fonctionnalités Guichet -->
                    <div class="row">
                        <!-- Génération d'attestations -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="mdi mdi-file-document me-2"></i>Attestations
                                    </h5>
                                </div>
                                <div class="card-body text-center">
                                    <i class="mdi mdi-file-document-outline fa-3x text-primary mb-3"></i>
                                    <p>Générer des attestations de scolarité pour les étudiants</p>
                                    <button class="btn btn-primary" disabled>Bientôt disponible</button>
                                </div>
                            </div>
                        </div>

                        <!-- Génération de certificats -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-success text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="mdi mdi-certificate me-2"></i>Certificats
                                    </h5>
                                </div>
                                <div class="card-body text-center">
                                    <i class="mdi mdi-certificate-outline fa-3x text-success mb-3"></i>
                                    <p>Éditer des certificats de réussite et diplômes</p>
                                    <button class="btn btn-success" disabled>Bientôt disponible</button>
                                </div>
                            </div>
                        </div>

                        <!-- Consultation cursus -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-info text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="mdi mdi-school me-2"></i>Cursus
                                    </h5>
                                </div>
                                <div class="card-body text-center">
                                    <i class="mdi mdi-school-outline fa-3x text-info mb-3"></i>
                                    <p>Consulter les cursus et parcours des étudiants</p>
                                    <button class="btn btn-info" disabled>Bientôt disponible</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <!-- Footer -->
            <?php $this->load->view('templates/footer'); ?>
