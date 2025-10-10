<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <div class="container-scroller">
    
    <!-- Sidebar -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="<?= base_url('etudiant') ?>"><img src="<?= base_url('assets/images/logo.svg') ?>" alt="logo" /></a>
            <a class="sidebar-brand brand-logo-mini" href="<?= base_url('etudiant') ?>"><img src="<?= base_url('assets/images/logo-mini.svg') ?>" alt="logo" /></a>
        </div>
        <ul class="nav">
            <li class="nav-item nav-category sidebar-title">
                <span class="full-title">Menu Principal</span>
                <span class="short-title">Menu</span>
            </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="<?= site_url('etudiant') ?>">
                <span class="menu-icon"><i class="mdi mdi-speedometer"></i></span>
                <span class="menu-title">Tableau de Bord</span>
            </a>
        </li>

            <!-- Mes Infos -->
            <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#mesInfos" aria-expanded="false" aria-controls="mesInfos">
                    <span class="menu-icon"><i class="mdi mdi-account-card-details"></i></span>
                    <span class="menu-title">Mes Infos</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="mesInfos">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('etudiant/infos_privees') ?>">Privées</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('etudiant/infos_scolaires') ?>">Scolaires</a></li>
                    </ul>
                </div>
            </li>


            
            
<!-- MENUS DYNAMIQUES depuis la base de données -->
<?php if(isset($menus_etudiant) && !empty($menus_etudiant)): ?>
    <?php foreach($menus_etudiant as $menu): ?>
        <li class="nav-item menu-items">
            <a class="nav-link" href="<?= site_url($menu['menu_url']) ?>">
                <span class="menu-icon"><i class="mdi <?= $menu['menu_icon'] ?>"></i></span>
                <span class="menu-title"><?= $menu['menu_nom'] ?></span>
            </a>
        </li>
    <?php endforeach; ?>
<?php else: ?>
    <!-- DEBUG: Aucun menu chargé -->
    <li><!-- Aucun menu dynamique --></li>
<?php endif; ?>            
            
            
            <!-- Inscription -->
<!--
            <li class="nav-item menu-items">
                <a class="nav-link" href="<?php echo site_url('etudiant/inscription_actuelle'); ?>">
                    <span class="menu-icon">
                        <i class="mdi mdi-file-document"></i>
                    </span>
                    <span class="menu-title">État d'Inscription</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="<?= site_url('etudiant/mes_groupes') ?>">
                    <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
                    <span class="menu-title">Mes Groupes</span>
                </a>
            </li>
-->
            <!-- Menu Déconnexion -->
            <li class="nav-item menu-items">
                <a class="nav-link" href="<?= site_url('auth/logout') ?>">
                    <span class="menu-icon"><i class="mdi mdi-logout"></i></span>
                    <span class="menu-title">Déconnexion</span>
                </a>
            </li>          
            
        </ul>
    </nav>