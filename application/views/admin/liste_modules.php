<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Main Panel -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-book-open menu-icon"></i>
                Gestion des Modules
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
                                        <th>VET_FIL</th>
                                        <th>VER_ETAPE</th>
                                        <th>CODE_FIL</th>
                                        <th>CODE_PARC</th>
                                        <th>SEMESTRE</th>
                                        <th>ANNEE</th>
                                        <th>CYCLE</th>
                                        <th>PERIODE</th>
                                        <th>CODE_SAPG</th>
                                        <th>LIBEL_MOD</th>
                                        <th>CODE_MOD</th>
                                        <th>CODE_MAPG</th>
                                        <th>NB_ELEM</th>
                                        <th>COEF_MOD</th>
                                        <th>NOTELIMSEM</th>
                                        <th>ORDRE_MOD</th>
                                        <th>MOD_OPT</th>
                                        <th>COORD_MOD</th>
                                        <th>SEM_EQUIV</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($modules as $module): ?>
                                    <tr>
                                        <td><?php echo $module['VET_FIL']; ?></td>
                                        <td><?php echo $module['VER_ETAPE']; ?></td>
                                        <td><?php echo $module['CODE_FIL']; ?></td>
                                        <td><?php echo $module['CODE_PARC']; ?></td>
                                        <td><?php echo $module['SEMESTRE']; ?></td>
                                        <td><?php echo $module['ANNEE']; ?></td>
                                        <td><?php echo $module['CYCLE']; ?></td>
                                        <td><?php echo $module['PERIODE']; ?></td>
                                        <td><?php echo $module['CODE_SAPG']; ?></td>
                                        <td><?php echo $module['LIBEL_MOD']; ?></td>
                                        <td><?php echo $module['CODE_MOD']; ?></td>
                                        <td><?php echo $module['CODE_MAPG']; ?></td>
                                        <td><?php echo $module['NB_ELEM']; ?></td>
                                        <td><?php echo $module['COEF_MOD']; ?></td>
                                        <td><?php echo $module['NOTELIMSEM']; ?></td>
                                        <td><?php echo $module['ORDRE_MOD']; ?></td>
                                        <td><?php echo $module['MOD_OPT']; ?></td>
                                        <td><?php echo $module['COORD_MOD']; ?></td>
                                        <td><?php echo $module['SEM_EQUIV']; ?></td>
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