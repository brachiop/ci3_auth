<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
    <?php $this->load->view('templates/sidebar'); ?>
        <?php $this->load->view('templates/navbar'); ?>

        <!-- Main Panel -->
        <div class="main-panel">
            <div class="content-wrapper">

                <!-- Ligne 1 : Infos personnelles & académiques -->
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Informations personnelles</h4>
                                <?php if (isset($etudiant) && is_array($etudiant)): ?>
                                
                                <p><strong>Nom :</strong> <span class="value"><?= display_value($etudiant, 'NOM') ?> <?= display_value($etudiant, 'PRENOM') ?></span></p>
                                
                                    <p><span class="label">Nom : </span><span class="value"><?= htmlspecialchars($etudiant['NOM']) ?> <?= htmlspecialchars($etudiant['PRENOM']) ?></span></p>
                                    <p><span class="label">CNE : </span><span class="value"><?= htmlspecialchars($etudiant['CNE']) ?></span></p>
                                    <p><span class="label">CIN : </span><span class="value"><?= htmlspecialchars($etudiant['CIN']) ?></span></p>
                                    <p><span class="label">Filière : </span><span class="value"><?= $this->session->userdata('code_fil') ? htmlspecialchars($this->session->userdata('code_fil')) : '' ?></span></p>
                                    <p><span class="label">Email : </span><span class="value"><?= htmlspecialchars($etudiant['EMAIL']) ?></span></p>
                                    <p><span class="label">Téléphone : </span><span class="value"><?= htmlspecialchars($etudiant['TEL']) ?></span></p>
                                    <p><span class="label">Date de naissance : </span><span class="value"><?= htmlspecialchars($etudiant['DATE_NAIS']) ?></span></p>
                                    <p><span class="label">Sexe : </span><span class="value"><?= htmlspecialchars($etudiant['SEXE']) ?></span></p>
                                <?php else: ?>
                                    <p>Aucune information disponible.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Informations académiques</h4>
                                <p><strong>Année universitaire : </strong><span class="value-acad"><?= isset($annee_univ) ? htmlspecialchars($annee_univ) : '2024/2025' ?></span></p>
                                <p><strong>Semestre actuel : </strong><span class="value-acad"><?= isset($this->session) && $this->session->userdata('semestre_actuel') ? htmlspecialchars($this->session->userdata('semestre_actuel')) : 'S1' ?></span></p>
                                <p><strong>Statut : </strong><span class="badge badge-success">Inscrit</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ligne 2 : Résumé rapide -->
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Résumé rapide</h4>
                                <ul>
                                    <li><strong>Mes Infos</strong> : Scolaires / Privées (menu)</li>
                                    <li><strong>Cursus</strong> : Modules et parcours (menu)</li>
                                    <li><strong>Inscription</strong> : Réinscription / Actuelle (menu)</li>
                                    <li><strong>Examens</strong> : Convocation / Résultat / Réclamation (menu)</li>
                                    <li><strong>Lois</strong> : Inscription / Évaluation / Cahier des normes (menu)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Footer -->
            <?php $this->load->view('templates/footer'); ?>
