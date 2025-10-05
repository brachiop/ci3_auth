<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/student_sidebar'); ?>
<?php $this->load->view('templates/navbar'); ?>

        <!-- Main Panel -->
        <div class="main-panel">
            <div class="content-wrapper">

                <!-- <div class="container"> -->
                    <h3>Informations Privées</h3>
                    
                    <div class="card">
                        <div class="card-body">
                        <?php if (!empty($etudiant) && is_array($etudiant)): ?>
                            <p><strong>Nom :</strong> <span class="value"><?= display_value($etudiant, 'NOM') ?> <?= display_value($etudiant, 'PRENOM') ?></span></p>
                            <p><strong>CIN :</strong> <span class="value"><?= display_value($etudiant, 'CIN') ?></span></p>
                            <p><strong>CNE :</strong> <span class="value"><?= display_value($etudiant, 'CNE') ?></span></p>
                            <p><strong>Email :</strong> <span class="value"><?= display_value($etudiant, 'EMAIL') ?></span></p>
                            <p><strong>Téléphone :</strong> <span class="value"><?= display_value($etudiant, 'TEL') ?></span></p>
                            <p><strong>Sexe :</strong> <span class="value">     <?= display_value($etudiant, 'SEXE') ?></span></p>
                        <?php else: ?>
                            <p>Aucune information disponible.</p>
                        <?php endif; ?>
                        </div>
                    </div>

                <!-- </div> -->

            </div>
            
            <!-- Footer -->
            <?php $this->load->view('templates/footer'); ?>
