<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Main Panel -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container-fluid">
        
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">

<div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <h4 class="card-title mb-0">
        <i class="mdi mdi-account-plus me-2"></i>Créer un nouvel utilisateur
    </h4>
    <a href="<?php echo site_url('admin/utilisateurs'); ?>" class="btn btn-light btn-sm">
        <i class="mdi mdi-arrow-left me-1"></i> Retour à la liste
    </a>
</div>

                <div class="card-body p-4">
                    
<!-- Messages d'alerte - VERSION SIMPLIFIÉE -->
<?php if (isset($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-alert-circle-outline me-2"></i>
        <?php echo $error; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!-- Messages avec Bootstrap 4 -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-circle-outline me-2"></i>
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-alert-circle-outline me-2"></i>
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

                    <form method="post" action="<?php echo site_url('admin/creer-utilisateur'); ?>">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="login" class="form-label">Login *</label>
                                    <input type="text" class="form-control <?php echo form_error('login') ? 'is-invalid' : ''; ?>" 
                                           id="login" name="login" 
                                           value="<?php echo set_value('login'); ?>" required>
                                    <?php if (form_error('login')): ?>
                                        <div class="invalid-feedback"><?php echo form_error('login'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cin" class="form-label">CIN *</label>
                                    <input type="text" class="form-control <?php echo form_error('cin') ? 'is-invalid' : ''; ?>" 
                                           id="cin" name="cin" 
                                           value="<?php echo set_value('cin'); ?>" required>
                                    <?php if (form_error('cin')): ?>
                                        <div class="invalid-feedback"><?php echo form_error('cin'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom *</label>
                                    <input type="text" class="form-control <?php echo form_error('prenom') ? 'is-invalid' : ''; ?>" 
                                           id="prenom" name="prenom" 
                                           value="<?php echo set_value('prenom'); ?>" required>
                                    <?php if (form_error('prenom')): ?>
                                        <div class="invalid-feedback"><?php echo form_error('prenom'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom *</label>
                                    <input type="text" class="form-control <?php echo form_error('nom') ? 'is-invalid' : ''; ?>" 
                                           id="nom" name="nom" 
                                           value="<?php echo set_value('nom'); ?>" required>
                                    <?php if (form_error('nom')): ?>
                                        <div class="invalid-feedback"><?php echo form_error('nom'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>" 
                                   id="email" name="email" 
                                   value="<?php echo set_value('email'); ?>" required>
                            <?php if (form_error('email')): ?>
                                <div class="invalid-feedback"><?php echo form_error('email'); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe *</label>
                                    <input type="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>" 
                                           id="password" name="password" required>
                                    <?php if (form_error('password')): ?>
                                        <div class="invalid-feedback"><?php echo form_error('password'); ?></div>
                                    <?php endif; ?>
                                    <small class="form-text text-muted">Minimum 8 caractères</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirm" class="form-label">Confirmer le mot de passe *</label>
                                    <input type="password" class="form-control <?php echo form_error('password_confirm') ? 'is-invalid' : ''; ?>" 
                                           id="password_confirm" name="password_confirm" required>
                                    <?php if (form_error('password_confirm')): ?>
                                        <div class="invalid-feedback"><?php echo form_error('password_confirm'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


<div class="mb-3">
    <label for="role" class="form-label fw-bold text-dark">Rôle *</label>
    <select class="form-select bg-white text-dark border-2 <?php echo form_error('role') ? 'is-invalid' : ''; ?>" 
            id="role" name="role" required style="border-color: #dee2e6;">
        <option value="" class="text-muted">Sélectionner un rôle</option>
        <?php foreach ($roles as $role): ?>
            <option value="<?php echo $role; ?>" <?php echo set_select('role', $role); ?>>
                <?php echo htmlspecialchars($role); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <?php if (form_error('role')): ?>
        <div class="invalid-feedback"><?php echo form_error('role'); ?></div>
    <?php endif; ?>
</div>
                        
                        

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="<?php echo site_url('admin/utilisateurs'); ?>" class="btn btn-secondary me-md-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Créer l'utilisateur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    </div>
    </div>
    
    <?php $this->load->view('templates/footer'); ?>
    
