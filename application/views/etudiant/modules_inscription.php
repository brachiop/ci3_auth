<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/student_sidebar'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Main Panel -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-file-document menu-icon"></i>
                État d'inscription de l'année universitaire <?= isset($annee_univ) ? $annee_univ : '' ?>
            </h3>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        
                        <!-- Informations Étudiant -->
                        <?php if($infos_etudiant): ?>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="alert alert-primary">
                                    <h4 class="alert-heading">
                                        Nom : &nbsp;<strong><?php echo $infos_etudiant['etudiant_info']['nom_prenom']; ?></strong> 
                                        <span style="float: right;">CNE :&nbsp;&nbsp;<strong><?php echo $infos_etudiant['etudiant_info']['cne']; ?></strong></span> 
                                    </h4>
                                </div>
                                <div class="alert alert-info">
                                    <h5 class="alert-heading">
                                        Filière :
                                        <strong><?php echo $infos_etudiant['filiere']['LIBEL_FIL'] . ' (' . $infos_etudiant['code_fil'] . ')'; ?></strong> 
                                    
                                        <?php if($infos_etudiant['parcours']): ?>
                                            <br /><br />
                                            <span style="float: right;">Parcours :
                                                <strong><?php echo $infos_etudiant['parcours']['LIBEL_PARC'] . ' (' . $infos_etudiant['code_parc'] . ')'; ?></strong> 
                                            </span>
                                            <br />
                                        <?php endif; ?>                                    
                                    
                                    </h5>
                                    
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Tableau Automne -->
                        <?php if(!empty($infos_etudiant['modules_automne'])): ?>
                        <div class="mb-5">
                            <h4 class="text-warning mb-3 text-center">
                                <i class="mdi mdi-leaf"></i>
                                Période d'Automne - 2025/2026
                            </h4>
                            <div class="table-responsive mx-auto">
                                <table class="table table-bordered table-striped">
                                    <thead style="background-color: #FFF085;">
                                        <tr">
                                            <th class="text-center" width="8%" style="color: blue; font-weight: bold;">SEM</th>
                                            <th class="text-center" width="8%" style="color: blue; font-weight: bold;">N°</th>
                                            <th class="text-center" width="15%" style="color: blue; font-weight: bold;">CODE</th>
                                            <th class="text-center" style="color: blue; font-weight: bold;">MODULE</th>
                                            <th class="text-center" width="10%" style="color: blue; font-weight: bold;">NI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($infos_etudiant['modules_automne'] as $module): ?>
                                        <tr>
                                            <td class="text-center">
                                                <h5 class="text-warning">
                                                    <strong>S<?php echo $module['semestre']; ?></strong>
                                                </h5>
                                            </td>
                                            <td class="text-center"><?php echo $module['module_num']; ?></td>
                                            
                                            <td class="text-center"><?php echo $module['code_mod']; ?></td>
                                            
                                            <td><span style="color: #FFD700;">
                                                <?php echo $module['libelle_mod']; ?>
                                            </span></td>
                                            
                                            <td class="text-center">
                                                <span class="badge badge-primary badge-pill" style="font-size: 1em;">
                                                    <?php echo $module['ni']; ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Tableau Printemps -->
                        <?php if(!empty($infos_etudiant['modules_printemps'])): ?>
                        <div class="mb-4">
                            <h4 class="text-success mb-3 text-center">
                                <i class="mdi mdi-flower"></i>
                                Période du Printemps - 2025/2026
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead style="background-color: #FFF085;">
                                        <tr">
                                            <th class="text-center" width="8%" style="color: blue; font-weight: bold;">SEM</th>
                                            <th class="text-center" width="8%" style="color: blue; font-weight: bold;">N°</th>
                                            <th class="text-center" width="15%" style="color: blue; font-weight: bold;">CODE</th>
                                            <th class="text-center" style="color: blue; font-weight: bold;">MODULE</th>
                                            <th class="text-center" width="10%" style="color: blue; font-weight: bold;">NI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($infos_etudiant['modules_printemps'] as $module): ?>
                                        <tr>
                                            <td class="text-center">
                                                <h5 class="text-success">
                                                    <strong>S<?php echo $module['semestre']; ?></strong>
                                                </h5>
                                            </td>
                                            <td class="text-center"><?php echo $module['module_num']; ?></td>
                                            
                                            <td class="text-center"><?php echo $module['code_mod']; ?></td>
                                            
                                            <!-- <td><span style="color: #FFD700;"> -->
                                            <td><span  class="text-success">
                                                <?php echo $module['libelle_mod']; ?>
                                            </span></td>
                                            <td class="text-center">
                                                <span class="badge badge-primary badge-pill" style="font-size: 1em;">
                                                    <?php echo $module['ni']; ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Résumé -->
                        <?php if(!empty($infos_etudiant['modules_automne']) || !empty($infos_etudiant['modules_printemps'])): ?>
                        <div class="mt-3 text-center">
                            <div class="alert alert-success">
                                <strong>
                                    Au total : <?php echo count($infos_etudiant['modules_automne']) + count($infos_etudiant['modules_printemps']); ?> modules
                                    (<?php echo count($infos_etudiant['modules_automne']); ?> Automne + <?php echo count($infos_etudiant['modules_printemps']); ?> Printemps)
                                </strong>
                            </div>
                        </div>
                        <?php else: ?>
                            <div class="alert alert-warning text-center">
                                <h5>Aucun module d'inscription trouvé</h5>
                            </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>