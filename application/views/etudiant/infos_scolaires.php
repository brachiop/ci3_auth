<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);
?>
<!-- Header -->
<?php $this->load->view('templates/header'); ?>

<div class="container-scroller">

<!-- Sidebar -->
<?php $this->load->view('templates/sidebar'); ?>    
    
    <!-- Page Body Wrapper -->
    <div class="container-fluid page-body-wrapper">
    
<!-- Navbar -->
<?php $this->load->view('templates/navbar'); ?>
 

        <!-- Main Panel -->
        <div class="main-panel">
            <div class="content-wrapper">


                <div class="container">
                    <h3>Informations Scolaires</h3>
                    <div class="card">
                        <div class="card-body">
                        <?php if ($this->session->userdata('code_fil')): ?>
                            <p><strong>Filière :</strong> <span class="value-acad"><?= session_value('code_fil', '') ?></span></p>
                            <p><strong>Année universitaire :</strong> <span class="value-acad"><?= session_value('annee_univ', '') ?></span></p>
                            <p><strong>Semestre actuel :</strong> <span class="value-acad"><?= session_value('semestre_actuel', 'S1') ?></span></p>
                            <p><strong>Statut :</strong> <span class="value-acad badge badge-success">Inscrit</span></p>
                        <?php else: ?>
                            <p>Aucune information disponible.</p>
                        <?php endif; ?>               
                        </div>
                    </div>
                </div>




            </div>
            
            <!-- Footer -->
            <?php $this->load->view('templates/footer'); ?>
            
        </div>
        <!-- main-panel ends -->

    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller ends -->

<!-- JS principal -->
<?php $this->load->view('templates/js'); ?>

</body>
</html>
