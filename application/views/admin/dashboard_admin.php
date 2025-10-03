<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/navbar'); ?>

        <div class="main-panel">
            <div class="content-wrapper">


                <div class="row">
                    <div class="col-12">
                        <h1 class="h3 mb-4"><i class="mdi mdi-view-dashboard me-2"></i>&nbsp;&nbsp;&nbsp;<?= $title ?></h1>
                    </div>
                </div>

                <!-- Cartes de statistiques - CONTENU CENTRÉ -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center p-2">  <!-- Ajout de text-center -->
                                <div class="d-flex flex-column align-items-center">  <!-- Centrage vertical -->
                                    <div class="mb-1">  <!-- Marge en bas pour l'icône -->
                                        <i class="mdi mdi-account-group" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1"><?= $stats['total_etudiants'] ?></h4>  <!-- Taille augmentée -->
                                        <p class="mb-0">Étudiants total</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center p-2">  <!-- Ajout de text-center -->
                                <div class="d-flex flex-column align-items-center">  <!-- Centrage vertical -->
                                    <div class="mb-1">  <!-- Marge en bas pour l'icône -->
                                        <i class="mdi mdi-account-check" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1"><?= $stats['connectes_aujourdhui'] ?></h4>  <!-- Taille augmentée -->
                                        <p class="mb-0">Connectés aujourd'hui</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center p-2">  <!-- Ajout de text-center -->
                                <div class="d-flex flex-column align-items-center">  <!-- Centrage vertical -->
                                    <div class="mb-1">  <!-- Marge en bas pour l'icône -->
                                        <i class="mdi mdi-shield-account" style="font-size: 1.5rem;"></i>
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

             <br />
             
             
        <div class="row">

            <!-- Carte Import Modules -->
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/images/dashboard/circle.svg'); ?>" class="card-img-absolute" alt="circle-image"/>
                        <h4 class="font-weight-normal mb-3">Import Modules</h4>
                        <p class="mb-4">Gérer les modules d'enseignement</p>
                        <a href="<?php echo site_url('import/modules'); ?>" class="btn btn-light btn-sm">
                            <i class="mdi mdi-upload me-1"></i>Accéder
                        </a>
                    </div>
                </div>
            </div>
                        
            <!-- Carte Import Parcours -->
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/images/dashboard/circle.svg'); ?>" class="card-img-absolute" alt="circle-image"/>
                        <h4 class="font-weight-normal mb-3">Import Parcours</h4>
                        <p class="mb-4">Gérer les parcours pédagogiques</p>
                        <a href="<?php echo site_url('import/parcours'); ?>" class="btn btn-light btn-sm">
                            <i class="mdi mdi-upload me-1"></i>Accéder
                        </a>
                    </div>
                </div>
            </div>
 
            <!-- Carte Import Filières -->
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/images/dashboard/circle.svg'); ?>" class="card-img-absolute" alt="circle-image"/>
                        <h4 class="font-weight-normal mb-3">Import Filières</h4>
                        <p class="mb-4">Gérer les filières académiques</p>
                        <a href="<?php echo site_url('import/filieres'); ?>" class="btn btn-light btn-sm">
                            <i class="mdi mdi-upload me-1"></i>Accéder
                        </a>
                    </div>
                </div>
            </div>
                        
        </div>
        
        <!-- Section Gestion Utilisateurs -->
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Gestion utilisateurs</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> Action </th>
                                        <th> Description </th>
                                        <th> Lien </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> Liste Utilisateurs </td>
                                        <td> Voir et gérer tous les utilisateurs </td>
                                        <td>
                                            <a href="<?php echo site_url('admin/utilisateurs'); ?>" class="btn btn-primary btn-sm">
                                                <i class="mdi mdi-account-multiple"></i> Accéder
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Créer Utilisateur </td>
                                        <td> Ajouter un nouvel utilisateur </td>
                                        <td>
                                            <a href="<?php echo site_url('admin/creer-utilisateur'); ?>" class="btn btn-success btn-sm">
                                                <i class="mdi mdi-account-plus"></i> Accéder
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
             
                
            </div> <!-- content-wrapper -->

            <?php $this->load->view('templates/footer'); ?>

