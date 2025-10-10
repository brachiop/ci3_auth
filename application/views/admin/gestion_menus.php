<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-menu"></i>
                Gestion des Menus Étudiant
            </h3>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ajouterMenuModal">
                <i class="mdi mdi-plus"></i> Ajouter un Menu
            </button>
        </div>

        <!-- Script de validation -->
        <script>
        function validerDates(form) {
            const dateDebut = form.querySelector('input[name="date_debut"]').value;
            const dateFin = form.querySelector('input[name="date_fin"]').value;
            
            // Si les deux dates sont remplies
            if (dateDebut && dateFin) {
                const debut = new Date(dateDebut);
                const fin = new Date(dateFin);
                
                if (debut > fin) {
                    alert('❌ Erreur : La date de début doit être antérieure à la date de fin.');
                    return false;
                }
                
                // Vérifier que la date de fin n'est pas dans le passé
                const aujourdhui = new Date();
                aujourdhui.setHours(0, 0, 0, 0); // Ignorer l'heure
                
                if (fin < aujourdhui) {
                    if (!confirm('⚠️ La date de fin est dans le passé. Voulez-vous vraiment continuer ?')) {
                        return false;
                    }
                }
            }
            
            // Si une seule date est remplie
            if ((dateDebut && !dateFin) || (!dateDebut && dateFin)) {
                alert('❌ Veuillez remplir les deux dates ou laisser les deux vides.');
                return false;
            }
            
            return true;
        }
        </script>
        
            <!-- Liste des menus existants -->
        <div class="row">
            <?php foreach($menus as $menu): ?>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    
                        <!-- En-tête du menu -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">
                                    <i class="mdi <?= $menu['menu_icon'] ?>"></i>
                                    <?= $menu['menu_nom'] ?>
                                </h4>
                                <p class="text-muted">Code: <?= $menu['menu_code'] ?></p>
                                
                                <!-- Affichage de la période -->
                                <?php if(!empty($menu['date_debut']) && !empty($menu['date_fin'])): ?>
                                <div class="mt-2">
                                    <small class="text-info">
                                        <i class="mdi mdi-calendar-range"></i>
                                        Du <?= date('d/m/Y', strtotime($menu['date_debut'])) ?> 
                                        au <?= date('d/m/Y', strtotime($menu['date_fin'])) ?>
                                        <?php if(strtotime($menu['date_fin']) < time()): ?>
                                            <span class="badge badge-warning ml-2">Période expirée</span>
                                        <?php endif; ?>
                                    </small>
                                </div>
                                <?php elseif($menu['est_actif'] && empty($menu['date_debut']) && empty($menu['date_fin'])): ?>
                                <div class="mt-2">
                                    <small class="text-success">
                                        <i class="mdi mdi-infinity"></i>
                                        Toujours visible
                                    </small>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Statut du menu -->
                            <div>
                                <?php if($menu['est_actif']): ?>
                                    <div style="background: #2D9966; color: white; padding: 8px 12px; border-radius: 20px; font-weight: normal;">
                                        <i class="mdi mdi-check-circle"></i> Activé
                                    </div>                           
                                <?php else: ?>
                                    <div style="background: #E1712B; color: white; padding: 8px 12px; border-radius: 20px; font-weight: normal;">
                                        <i class="mdi mdi-close-circle"></i> Désactivé
                                    </div>                                 
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Formulaire d'activation avec validation -->
                        <form method="post" action="<?= site_url('admin_menus/activer_menu') ?>" onsubmit="return validerDates(this)">
                            <input type="hidden" name="menu_code" value="<?= $menu['menu_code'] ?>">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date début</label>
                                        <input type="date" name="date_debut" class="form-control" 
                                               value="<?= !empty($menu['date_debut']) ? $menu['date_debut'] : '' ?>"
                                               min="<?= date('Y-m-d') ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date fin</label>
                                        <input type="date" name="date_fin" class="form-control"
                                               value="<?= !empty($menu['date_fin']) ? $menu['date_fin'] : '' ?>"
                                               min="<?= date('Y-m-d') ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Indicateur visuel de validation -->
                            <div class="alert alert-info" style="font-size: 0.9em;">
                                <i class="mdi mdi-information"></i>
                                <strong>Règles de validation :</strong><br>
                                • Les deux dates doivent être remplies ou les deux vides<br>
                                • Date début < Date fin<br>
                                • Dates futures recommandées
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-check"></i> 
                                    <?= $menu['est_actif'] ? 'Mettre à jour' : 'Activer' ?>
                                </button>
                                
                                <?php if($menu['est_actif']): ?>
                                <a href="<?= site_url('admin_menus/desactiver_menu/' . $menu['menu_code']) ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Êtes-vous sûr de vouloir désactiver ce menu ?')">
                                    <i class="mdi mdi-close"></i> Désactiver
                                </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Modal d'ajout de menu -->
        <div class="modal fade" id="ajouterMenuModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un Nouveau Menu</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <form method="post" action="<?= site_url('admin_menus/ajouter_menu') ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Code du Menu *</label>
                                <input type="text" name="menu_code" class="form-control" required 
                                       placeholder="ex: mes_notes, mes_absences">
                                <small class="form-text text-muted">Unique, sans espaces, en minuscules</small>
                            </div>
                            <div class="form-group">
                                <label>Nom du Menu *</label>
                                <input type="text" name="menu_nom" class="form-control" required 
                                       placeholder="ex: Mes Notes, Mes Absences">
                            </div>
                            <div class="form-group">
                                <label>Icône MDI</label>
                                <input type="text" name="menu_icon" class="form-control" 
                                       value="mdi-star" placeholder="mdi-account, mdi-book, etc.">
                                <small class="form-text text-muted">
                                    <a href="https://materialdesignicons.com/" target="_blank">Voir les icônes disponibles</a>
                                </small>
                            </div>
                            <div class="form-group">
                                <label>URL *</label>
                                    <input type="text" name="menu_url" class="form-control" required 
                                    value="etudiant/<?= isset($_POST['menu_code']) ? $_POST['menu_code'] : '' ?>" 
                                    placeholder="ex: etudiant/mes_notes" id="menu_url_field">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success">Créer le Menu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        
    </div><!-- EndWrapper -->
    
    <!-- Modal Ajout Menu -->
<script>
$(document).ready(function(){
    // Réinitialiser le formulaire à chaque ouverture
    $('#ajouterMenuModal').on('show.bs.modal', function () {
        $(this).find('form')[0].reset();
    });
});
</script>

<!-- Auto-remplissage URL-->
<script>
$(document).ready(function() {
    // Auto-remplir l'URL quand le code menu change
    $('input[name="menu_code"]').on('input', function() {
        var menuCode = $(this).val().toLowerCase().replace(/\s+/g, '_');
        $('#menu_url_field').val('etudiant/' + menuCode);
    });
});
</script>


