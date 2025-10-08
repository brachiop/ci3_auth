<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Menu temporaire fixe en attendant la correction -->
        <li class="nav-item menu-items">
            <a class="nav-link" href="<?= site_url('etudiant/dashboard') ?>">
                <span class="menu-icon"><i class="mdi mdi-speedometer"></i></span>
                <span class="menu-title">Tableau de Bord</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="<?= site_url('etudiant/mes_groupes') ?>">
                <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
                <span class="menu-title">Mes Groupes</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="<?= site_url('etudiant/inscription_actuelle') ?>">
                <span class="menu-icon"><i class="mdi mdi-book-multiple"></i></span>
                <span class="menu-title">Mes Modules</span>
            </a>
        </li>
        
        <!-- Menu Déconnexion -->
        <li class="nav-item menu-items">
            <a class="nav-link" href="<?= site_url('auth/logout') ?>">
                <span class="menu-icon"><i class="mdi mdi-logout"></i></span>
                <span class="menu-title">Déconnexion</span>
            </a>
        </li>
    </ul>
</nav>