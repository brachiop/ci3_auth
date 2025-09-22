<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <!-- Sidebar -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="<?= base_url('dashboard') ?>"><img src="<?= base_url('assets/images/logo.svg') ?>" alt="logo" /></a>
            <a class="sidebar-brand brand-logo-mini" href="<?= base_url('dashboard') ?>"><img src="<?= base_url('assets/images/logo-mini.svg') ?>" alt="logo" /></a>
        </div>
        <ul class="nav">
            <li class="nav-item nav-category sidebar-title">
                <span class="full-title">Menu Principal</span>
                <span class="short-title">Menu</span>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
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

            <!-- Cursus -->
            <li class="nav-item menu-items">
                <a class="nav-link" href="<?= site_url('cursus') ?>">
                    <span class="menu-icon"><i class="mdi mdi-school"></i></span>
                    <span class="menu-title">Cursus</span>
                </a>
            </li>

            <!-- Inscription -->
            <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#inscription" aria-expanded="false" aria-controls="inscription">
                    <span class="menu-icon"><i class="mdi mdi-pencil-box-outline"></i></span>
                    <span class="menu-title">Inscription</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="inscription">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('inscription/reinscription') ?>">Réinscription</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('inscription/actuelle') ?>">Actuelle</a></li>
                    </ul>
                </div>
            </li>

            <!-- Examens -->
            <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#examens" aria-expanded="false" aria-controls="examens">
                    <span class="menu-icon"><i class="mdi mdi-book-open-page-variant"></i></span>
                    <span class="menu-title">Examens</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="examens">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('examens/convocation') ?>">Convocation</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('examens/resultat') ?>">Résultat</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('examens/reclamation') ?>">Réclamation</a></li>
                    </ul>
                </div>
            </li>

            <!-- Lois -->
            <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#lois" aria-expanded="false" aria-controls="lois">
                    <span class="menu-icon"><i class="mdi mdi-gavel"></i></span>
                    <span class="menu-title">Lois</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="lois">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('lois/inscription') ?>">Inscription</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('lois/evaluation') ?>">Évaluation</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('lois/cahier_normes') ?>">Cahier des normes</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
    