<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Main Panel -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-school menu-icon"></i>
                Gestion des Filieres
            </h3>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ANNEE</th>
                                        <th>VET_FIL</th>
                                        <th>CODE_FIL</th>
                                        <th>LIBEL_FIL</th>
                                        <th>LIBEL_F_A</th>
                                        <th>DISPONIBLE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($filieres as $filiere): ?>
                                    <tr>
                                        <td><?= $filiere['CODE_FIL'] ?></td>
                                        <td><?= $filiere['LIBEL_FIL'] ?></td>
                                        <td><?= $filiere['TYPE'] ?></td>
                                        <td><?= $filiere['SEM_DEPART'] ?></td>
                                        <td><?= $filiere['NB_PARC'] ?></td>
                                        <td><?= $filiere['DISCIPLINE'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>