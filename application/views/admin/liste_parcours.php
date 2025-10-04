<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Main Panel -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-book-multiple menu-icon"></i>
                Gestion des Parcours
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
                                        <th>CODE_PARC</th>
                                        <th>ORDRE_PARC</th>
                                        <th>LIBEL_PARC</th>
                                        <th>LIBEL_P_A</th>
                                        <th>SEMESTRES</th>
                                        <th>DISPONIBLE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($parcours as $parc): ?>
                                    <tr>
                                        <td><?php echo $parc['ANNEE']; ?></td>
                                        <td><?php echo $parc['VET_FIL']; ?></td>
                                        <td><?php echo $parc['CODE_FIL']; ?></td>
                                        <td><?php echo $parc['CODE_PARC']; ?></td>
                                        <td><?php echo $parc['ORDRE_PARC']; ?></td>
                                        <td><?php echo $parc['LIBEL_PARC']; ?></td>
                                        <td><?php echo $parc['LIBEL_P_A']; ?></td>
                                        <td><?php echo $parc['SEMESTRES']; ?></td>
                                        <td><?php echo $parc['DISPONIBLE']; ?></td>
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