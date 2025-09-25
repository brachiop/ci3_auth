<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

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

                <div class="container-fluid">
                    <!-- Titre -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h1 class="h3 mb-0"><?= $title ?></h1>
                                <a href="<?= site_url('dashboard_admin') ?>" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i>Retour
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Carte de statistiques -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center p-3">
                <h5 class="mb-1"><?= $this->Etudiant_model->get_total_etudiants() ?> Étudiants au total</h5>
                <!-- <p class="mb-0 small"></p> -->
            </div>
        </div>
    </div>
</div>

                    <!-- Barre de recherche SIMPLE ET CLAIRE -->

<!-- Barre de recherche AVEC PLACEHOLDER DÉTAILLÉ -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form id="searchForm">
                    <div class="input-group">
                        <input type="text" class="form-control" 
                               placeholder="Recherche par Nom, Prénom, CNE, Code Massar" 
                               id="searchInput" value="<?= $this->input->get('search') ?>">
                        <button class="btn btn-primary" type="submit">
                            <i class="mdi mdi-magnify"></i> Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>                    
                    

                    <!-- Tableau des étudiants -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Liste des étudiants</h5>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($etudiants)): ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>CNE</th>
                                                        <th>Massar</th>
                                                        <th>Nom</th>
                                                        <th>Prénom</th>
                                                        <th>Email</th>
                                                        <th>Téléphone</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($etudiants as $etudiant): ?>
                                                    <tr>
                                                        <td><?= $etudiant['CNE'] ?></td>
                                                        <td><?= $etudiant['C_MASSAR'] ?></td>
                                                        <td><?= $etudiant['NOM'] ?></td>
                                                        <td><?= $etudiant['PRENOM'] ?></td>
                                                        <td><?= $etudiant['EMAIL'] ?: '<span class="text-muted">Non renseigné</span>' ?></td>
                                                        <td><?= $etudiant['TEL'] ?: '<span class="text-muted">Non renseigné</span>' ?></td>
                                                        <td>
                                                            <a href="<?= site_url('etudiants_admin/voir/' . $etudiant['ID']) ?>" 
                                                               class="btn btn-sm btn-info" title="Voir détails">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Pagination -->
                                        <?php if (!empty($pagination)): ?>
                                        <div class="d-flex justify-content-center mt-4">
                                            <?= $pagination ?>
                                        </div>
                                        <?php endif; ?>

                                    <?php else: ?>
                                        <div class="text-center py-4">
                                            <i class="mdi mdi-account-multiple fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Aucun étudiant trouvé</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
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

<script>
document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const term = document.getElementById('searchInput').value.trim();
    if (term) {
        window.location.href = '<?= site_url('etudiants_admin') ?>?search=' + encodeURIComponent(term);
    } else {
        window.location.href = '<?= site_url('etudiants_admin') ?>';
    }
});
</script>

</body>
</html>