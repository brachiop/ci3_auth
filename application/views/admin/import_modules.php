<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Main Panel -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-upload me-2"></i>
                <?php echo $title; ?>
            </h3>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        
                        <!-- Messages d'alerte -->
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

                        <div class="alert alert-info">
                            <h6 class="alert-heading">Instructions :</h6>
                            <ul class="mb-0">
                                <li>Préparez un fichier CSV <span style="color: red;">selon le template</span></li>
                                <li>La première ligne doit contenir les entêtes</li>
                                <li>Encodage : UTF-8</li>
                                <li>Séparateur : Virgule</li>
                                <li>Téléchargez le template ci-dessous pour avoir la bonne structure</li>
                            </ul>
                                    </div>

                        <form method="post" enctype="multipart/form-data" action="<?php echo site_url('import/modules'); ?>">
                            <div class="form-group">
                                <label for="fichier_csv" class="text-success font-weight-bold">Fichier CSV :</label>
                                <input type="file" name="fichier_csv" class="form-control-file" accept=".csv" required>
                                 <small class="form-text text-light">
                                    Formats acceptés : CSV (max 5MB)
                                </small>
                            </div>
                            <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-upload me-2"></i> Importer Parcours
                            </button>
                                <a href="<?php echo site_url('dashboard_admin'); ?>" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i>Retour
                                </a>
                                
                                <!-- BOUTON TÉLÉCHARGER TEMPLATE -->
                                <a href="<?php echo site_url('download-template/modules'); ?>" class="btn btn-outline-warning float-right">
                                    <i class="mdi mdi-download me-2"></i>Télécharger le Template
                                </a>
                            </div>                                
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>