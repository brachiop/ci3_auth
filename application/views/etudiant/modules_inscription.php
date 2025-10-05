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
                État d'inscription de l'année universitaire 2025/2026
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
                                    <h5 class="alert-heading">Informations de l'étudiant</h5>
                                    <p class="mb-1">
                                        <strong>CNE :</strong> <?php echo $infos_etudiant['etudiant_info']['cne']; ?>
                                        &nbsp; | &nbsp;
                                        <strong>Massar :</strong> <?php echo $infos_etudiant['etudiant_info']['c_massar']; ?>
                                        &nbsp; | &nbsp;
                                        <strong>Nom :</strong> <?php echo $infos_etudiant['etudiant_info']['nom_prenom']; ?>
                                    </p>
                                </div>
                                <div class="alert alert-info">
                                    <h5 class="alert-heading">Informations de formation</h5>
                                    <p class="mb-1">
                                        <strong>Filière :</strong> 
                                        <?php echo $infos_etudiant['filiere']['LIBEL_FIL'] . ' (' . $infos_etudiant['code_fil'] . ')'; ?>
                                    </p>
                                    <?php if($infos_etudiant['parcours']): ?>
                                    <p class="mb-0">
                                        <strong>Parcours :</strong> 
                                        <?php echo $infos_etudiant['parcours']['LIBEL_PARC'] . ' (' . $infos_etudiant['code_parc'] . ')'; ?>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Tableau Automne -->
                        <?php if(!empty($infos_etudiant['modules_automne'])): ?>
                        <div class="mb-5">
                            <h4 class="text-warning mb-3">
                                <i class="mdi mdi-leaf"></i>
                                Période d'Automne - 2025/2026
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="8%">SEM</th>
                                            <th width="8%">N°</th>
                                            <th width="15%">CODE</th>
                                            <th>MODULE</th>
                                            <th width="10%">NI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($infos_etudiant['modules_automne'] as $module): ?>
                                        <tr>
                                            <td class="text-center">
                                                <strong>S<?php echo $module['semestre']; ?></strong>
                                            </td>
                                            <td class="text-center">
                                                <strong><?php echo $module['module_num']; ?></strong>
                                            </td>
                                            <td>
                                                <code><?php echo $module['code_mod']; ?></code>
                                            </td>
                                            <td><?php echo $module['libelle_mod']; ?></td>
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
                            <h4 class="text-success mb-3">
                                <i class="mdi mdi-flower"></i>
                                Période du Printemps - 2025/2026
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="8%">SEM</th>
                                            <th width="8%">N°</th>
                                            <th width="15%">CODE</th>
                                            <th>MODULE</th>
                                            <th width="10%">NI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($infos_etudiant['modules_printemps'] as $module): ?>
                                        <tr>
                                            <td class="text-center">
                                                <strong>S<?php echo $module['semestre']; ?></strong>
                                            </td>
                                            <td class="text-center">
                                                <strong><?php echo $module['module_num']; ?></strong>
                                            </td>
                                            <td>
                                                <code><?php echo $module['code_mod']; ?></code>
                                            </td>
                                            <td><?php echo $module['libelle_mod']; ?></td>
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
                                    Total : <?php echo count($infos_etudiant['modules_automne']) + count($infos_etudiant['modules_printemps']); ?> module(s) inscrit(s)
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