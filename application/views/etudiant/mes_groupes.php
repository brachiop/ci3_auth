<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php 
/*
$this->load->view('templates/header');
$this->load->view('templates/student_sidebar', ['menus_etudiant' => $menus_etudiant]);
$this->load->view('templates/student_sidebar'); 
$this->load->view('templates/navbar'); 
*/
?>

<!-- Main Panel -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-account-group menu-icon"></i>
                Mes Groupes et Sections
            </h3>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- Titre dynamique selon le semestre -->
                        <?php if(!empty($sections)): ?>
                            <?php 
                            $premier_semestre = $sections[0]['SEMESTRE'];
                            $periode = ($premier_semestre % 2 == 1) ? 'Automne' : 'Printemps';
                            ?>
                            <h4 class="text-warning mb-3 text-center">
                                <i class="mdi mdi-<?= ($periode == 'Automne') ? 'leaf' : 'flower' ?>"></i>
                                Période d'<?= $periode ?> - Année Universitaire <?= $annee_univ ?>
                            </h4>
                        <?php endif; ?>
                        
                        <?php if(empty($sections)): ?>
                            <div class="alert alert-info text-center">
                                <i class="mdi mdi-information-outline"></i>
                                Aucune information de groupe disponible pour le moment.
                            </div>
                        <?php else: ?>
                            
                            <!-- Carte synthèse -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="alert alert-primary">
                                        <div class="row text-center">
                                            <div class="col-md-4 border-right">
                                                <h6 class="text-muted">Filière</h6>
                                                <h5><?= $etudiant_info['code_fil'] ?></h5>
                                            </div>
                                            <div class="col-md-4 border-right">
                                                <h6 class="text-muted">Parcours</h6>
                                                <h5><?= $etudiant_info['code_parc'] ?></h5>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="text-muted">CNE</h6>
                                                <h5><?= $etudiant_info['cne'] ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tableau des sections par semestre -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align:center; width: 20%; background: #2c3e50; color: white;">Semestre</th>
                                            <th style="text-align:center; width: 25%; background: #2c3e50; color: white;">Section</th>
                                            <th style="text-align:center; width: 25%; background: #2c3e50; color: white;">Groupe TD</th>
                                            <th style="text-align:center; width: 30%; background: #2c3e50; color: white;">Groupe TP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($sections as $section): ?>
                                        <tr>
                                            <td class="text-center">
                                                <span class="badge badge-primary badge-pill" style="font-size: 1.1em;">
                                                    S<?= $section['SEMESTRE'] ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-success" style="font-size: 1em;">
                                                    <?= $section['SECTION'] ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-info" style="font-size: 1em;">
                                                    <?= $section['GROUPE_TD'] ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-warning" style="font-size: 1em;">
                                                    <?= $section['GROUPE_TP'] ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Légende -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="alert alert-light">
                                        <h6 class="text-muted">Légende :</h6>
                                        <span class="badge badge-primary mr-2">Semestre</span>
                                        <span class="badge badge-success mr-2">Section</span>
                                        <span class="badge badge-info mr-2">Travaux Dirigés</span>
                                        <span class="badge badge-warning">Travaux Pratiques</span>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php //$this->load->view('templates/footer'); ?>
