<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php 
/*
$this->load->view('templates/header');
$this->load->view('templates/student_sidebar');
$this->load->view('templates/navbar');
*/
?> 
        <!-- Main Panel -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container">
                    <h3>Informations Scolaires</h3>
                    <div class="card">
                        <div class="card-body">
                        <?php if ($this->session->userdata('code_fil')): ?>
                            <p><strong>Filière :</strong> <span class="value-acad"><?= session_value('code_fil', '') ?></span></p>
                            <p><strong>Année universitaire :</strong> <span class="value-acad"><?= isset($annee_univ) ? $annee_univ : '' ?></span></p>
                            <p><strong>Semestre actuel :</strong> <span class="value-acad"><?= session_value('semestre_actuel', 'S1') ?></span></p>
                            <p><strong>Statut :</strong> <span class="badge badge-success">Inscrit</span></p>
                        <?php else: ?>
                            <p>Aucune information disponible.</p>
                        <?php endif; ?>               
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <?php //$this->load->view('templates/footer'); ?>
