<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

        <!-- Navbar -->
        <nav class="navbar fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                <a class="navbar-brand brand-logo-mini" href="#"><img src="<?= base_url('assets/images/logo-mini.svg') ?>" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav w-100">
                    <li class="nav-item w-100">
                        <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                            <input type="text" class="form-control" placeholder="Rechercher...">
                        </form>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <!-- Profil et notifications -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                            <div class="navbar-profile">
                                <img class="img-xs rounded-circle" src="<?= base_url('assets/images/faces/default-avatar.png') ?>" alt="">
                                <p class="mb-0 d-none d-sm-block navbar-profile-name"><?= isset($etudiant['NOM_L']) ? htmlspecialchars($etudiant['NOM_L']) : 'Étudiant' ?></p>
                                <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list">
                            <a class="dropdown-item preview-item" href="<?= site_url('profile') ?>">
                                <div class="preview-thumbnail"><div class="preview-icon bg-dark rounded-circle"><i class="mdi mdi-account text-success"></i></div></div>
                                <div class="preview-item-content"><p class="preview-subject mb-1">Mon Profil</p></div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item" href="<?= site_url('auth/logout') ?>">
                                <div class="preview-thumbnail"><div class="preview-icon bg-dark rounded-circle"><i class="mdi mdi-logout text-danger"></i></div></div>
                                <div class="preview-item-content"><p class="preview-subject mb-1">Déconnexion</p></div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

