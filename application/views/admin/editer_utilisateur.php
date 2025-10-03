<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Main Panel -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-account-edit me-2"></i>
                <?php echo $title; ?>
            </h3>
        </div>
        
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        
                        <!-- Messages d'alerte -->
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




<form method="post" action="<?php echo site_url('admin/editer-utilisateur/' . $user->ID); ?>">
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="login" class="form-label text-success font-weight-bold">Login *</label>
                <input type="text" class="form-control <?php echo form_error('login') ? 'is-invalid' : ''; ?>" 
                       id="login" name="login" 
                       value="<?php echo set_value('login', $user->LOGIN); ?>" required>
                <?php if (form_error('login')): ?>
                    <div class="invalid-feedback"><?php echo form_error('login'); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="cin" class="form-label text-success font-weight-bold">CIN *</label>
                <input type="text" class="form-control <?php echo form_error('cin') ? 'is-invalid' : ''; ?>" 
                       id="cin" name="cin" 
                       value="<?php echo set_value('cin', $user->CIN); ?>" required>
                <?php if (form_error('cin')): ?>
                    <div class="invalid-feedback"><?php echo form_error('cin'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="prenom" class="form-label text-success font-weight-bold">Prénom *</label>
                <input type="text" class="form-control <?php echo form_error('prenom') ? 'is-invalid' : ''; ?>" 
                       id="prenom" name="prenom" 
                       value="<?php echo set_value('prenom', $user->PRENOM); ?>" required>
                <?php if (form_error('prenom')): ?>
                    <div class="invalid-feedback"><?php echo form_error('prenom'); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nom" class="form-label text-success font-weight-bold">Nom *</label>
                <input type="text" class="form-control <?php echo form_error('nom') ? 'is-invalid' : ''; ?>" 
                       id="nom" name="nom" 
                       value="<?php echo set_value('nom', $user->NOM); ?>" required>
                <?php if (form_error('nom')): ?>
                    <div class="invalid-feedback"><?php echo form_error('nom'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="form-label text-success font-weight-bold">Email *</label>
        <input type="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>" 
               id="email" name="email" 
               value="<?php echo set_value('email', $user->EMAIL); ?>" required>
        <?php if (form_error('email')): ?>
            <div class="invalid-feedback"><?php echo form_error('email'); ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="password" class="form-label text-success font-weight-bold">Nouveau mot de passe</label>
        <input type="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>" 
               id="password" name="password">
        <?php if (form_error('password')): ?>
            <div class="invalid-feedback"><?php echo form_error('password'); ?></div>
        <?php endif; ?>
        <small class="form-text text-light">Laissez vide pour ne pas modifier le mot de passe</small>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="role" class="form-label text-success font-weight-bold">Rôle *</label>
                <select class="form-control <?php echo form_error('role') ? 'is-invalid' : ''; ?>" 
                        id="role" name="role" required>
                    <option value="">Sélectionner un rôle</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo $role; ?>" <?php echo set_select('role', $role, $user->ROLE == $role); ?>>
                            <?php echo htmlspecialchars($role); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (form_error('role')): ?>
                    <div class="invalid-feedback"><?php echo form_error('role'); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="statut" class="form-label text-success font-weight-bold">Statut *</label>
                <select class="form-control <?php echo form_error('statut') ? 'is-invalid' : ''; ?>" 
                        id="statut" name="statut" required>
                    <option value="">Sélectionner un statut</option>
                    <option value="ACTIF" <?php echo set_select('statut', 'ACTIF', $user->STATUT == 'ACTIF'); ?>>Actif</option>
                    <option value="INACTIF" <?php echo set_select('statut', 'INACTIF', $user->STATUT == 'INACTIF'); ?>>Inactif</option>
                </select>
                <?php if (form_error('statut')): ?>
                    <div class="invalid-feedback"><?php echo form_error('statut'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <a href="<?php echo site_url('utilisateurs_admin'); ?>" class="btn btn-secondary me-2">Annuler</a>
        <button type="submit" class="btn btn-primary">Modifier l'utilisateur</button>
    </div>
</form>




                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $this->load->view('templates/footer'); ?>
