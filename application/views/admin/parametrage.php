<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-cog menu-icon"></i>
                Paramétrage de l'Application
            </h3>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-transform: none; font-size: 1.3rem; font-weight: 500; margin-bottom: 20px;">
                        <!-- <h4 style="font-size: 1.3rem; font-weight: 400; margin-bottom: 20px; text-transform: none;"> -->
                            Paramètres de l'année universitaire
                        </h4>
                        
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                        <?php endif; ?>
                        
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                        <?php endif; ?>

                        <form method="post" action="<?= site_url('parametrage/sauvegarder') ?>">
                            <!-- Année Universitaire -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Année d'Inscription *</label>
                                        <input type="number" name="an_inscr" class="form-control" 
                                               value="<?= $parametres ? $parametres['an_inscr'] : '2026' ?>" required>
                                        <small class="form-text text-muted">Ex: 2026 pour l'année universitaire 2025/2026</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Table Inscription</label>
                                        <input type="text" name="tbl_inscription" class="form-control" 
                                               value="<?= $parametres ? $parametres['tbl_inscription'] : 'inscription' ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Tables principales -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Préfixe Table réinscription</label>
                                        <input type="text" name="prefix_oletud" class="form-control" 
                                               value="<?= $parametres ? $parametres['prefix_oletud'] : 'oletud' ?>">
                                        <small class="form-text text-muted">Exemple: "oletud" pour oletud26, "reinscr" pour reinscr26</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Table Modules</label>
                                        <input type="text" name="tbl_modules" class="form-control" 
                                               value="<?= $parametres ? $parametres['tbl_modules'] : 'modules24' ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Table Filières</label>
                                        <input type="text" name="tbl_filieres" class="form-control" 
                                               value="<?= $parametres ? $parametres['tbl_filieres'] : 'filieres24' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Table Parcours</label>
                                        <input type="text" name="tbl_parcours" class="form-control" 
                                               value="<?= $parametres ? $parametres['tbl_parcours'] : 'parc24' ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Table Infos des étudiants</label>
                                        <input type="text" name="tbl_Fetudg" class="form-control" 
                                               value="<?= $parametres ? $parametres['tbl_Fetudg'] : 'fetudg' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Table: Autorisés à se connecter</label>
                                        <input type="text" name="tbl_autorise" class="form-control" 
                                               value="<?= $parametres ? $parametres['tbl_autorise'] : 'autorise' ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Paramètres techniques (en bas) -->
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre de Modules</label>
                                        <input type="number" name="nbr_modules" class="form-control" 
                                               value="<?= $parametres ? $parametres['nbr_modules'] : '42' ?>">
                                        <small class="form-text text-muted">42 modules pour les 6 semestres</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre Tentatives</label>
                                        <input type="number" name="nbr_tent" class="form-control" 
                                               value="<?= $parametres ? $parametres['nbr_tent'] : '5' ?>">
                                        <small class="form-text text-muted">Nombre maximum de tentatives de réinscription</small>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="mdi mdi-content-save"></i> Sauvegarder
                            </button>
                            <a href="<?= site_url('admin') ?>" class="btn btn-light">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>