<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-menu"></i>
                Gestion des Menus Étudiant
            </h3>
        </div>

        <div class="row">
            <?php foreach($menus as $menu): ?>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    
                        <!-- *********************************************************** -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">
                                    <i class="mdi <?= $menu['menu_icon'] ?>"></i>
                                    <?= $menu['menu_nom'] ?>
                                </h4>
                                <p class="text-muted">Code: <?= $menu['menu_code'] ?></p>
                            </div>
                            <div>
                                <?php if($menu['est_actif']): ?>
                                    <!-- <span class="badge badge-success">Activé</span> -->
            <div style="background: #2D9966; color: white; padding: 8px 12px; border-radius: 20px; font-weight: normal;">
                <i class="mdi mdi-check-circle"></i> Activé
            </div>                           
                                
                                <?php else: ?>
                                    <!-- <span class="badge badge-secondary">Désactivé</span> -->
            <div style="background: #E1712B; color: white; padding: 8px 12px; border-radius: 20px; font-weight: normal;">
                <i class="mdi mdi-close-circle"></i> Désactivé
            </div>                                 
                                    
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- *********************************************************** -->
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <!-- Formulaire d'activation temporelle -->
                        <form method="post" action="<?= site_url('admin_menus/activer') ?>">
                            <input type="hidden" name="menu_code" value="<?= $menu['menu_code'] ?>">
                            
                            
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Date début</label>
            <input type="datetime-local" name="date_debut" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Date fin</label>
            <input type="datetime-local" name="date_fin" class="form-control">
        </div>
    </div>
</div>

<!-- AJOUTER ce texte explicatif -->
<div class="alert alert-info" style="font-size: 0.9em;">
    <i class="mdi mdi-information"></i>
    <strong>Note :</strong> 
    Laissez les dates vides pour rendre le menu <strong>toujours visible</strong>.<br>
    Remplissez les dates pour une <strong>activation temporaire</strong>.
</div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-check"></i> Activer
                                </button>
                                
                                <?php if($menu['est_actif'] && !$menu['visible_toujours']): ?>
                                <a href="<?= site_url('admin_menus/desactiver/'.$menu['menu_code']) ?>" 
                                   class="btn btn-danger btn-sm">
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
    </div>
</div>