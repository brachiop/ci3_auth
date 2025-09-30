<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Numérique Personnel - Authentification</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Style personnalisé -->
    <style>
        .auth-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        .auth-header {
            background: #2c3e50;
            color: white;
            padding: 25px 30px; /* Plus d'espace interne */
            text-align: center;
        }
        .auth-header h2 {
            margin: 0 0 15px 0; /* 20px d'espace sous le titre */
            font-weight: 400;
            font-size: 1.4rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .auth-header p {
            margin: 8px 0 0 0;
            font-size: 0.9rem;
            opacity: 0.8;
        }
        .auth-header .subtitle {
            font-size: 1.1rem;
            margin: 0;
            font-weight: 500;
            opacity: 0.95;
            letter-spacing: 0.5px;
        }        
        .auth-body {
            padding: 25px;
        }
        .nav-tabs {
            border-bottom: 2px solid #e9ecef;
            margin-bottom: 25px;
        }
        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 12px 20px;
        }
        .nav-tabs .nav-link.active {
            color: #3498db;
            border-bottom: 3px solid #3498db;
            background: transparent;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        .btn-auth {
            background: #3498db;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-auth:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 8px;
            border: none;
            padding: 12px 15px;
        }
            /* Adaptation mobile */
    @media (max-width: 480px) {
        .auth-header h2 {
            font-size: 1.2rem;
        }
        .auth-header {
            padding: 20px 25px;
        }
        .auth-body {
            padding: 20px;
        }
    }
    
    @media (max-width: 360px) {
        .auth-header h2 {
            font-size: 1.1rem;
        }
    }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>
                    <i class="fas fa-graduation-cap me-2"></i>Espace Numérique Personnel
                </h2>
                <p class="subtitle">Authentification</p>
            </div>
            
            <div class="auth-body">
                <!-- Onglets -->
                <ul class="nav nav-tabs" id="authTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="etudiant-tab" data-bs-toggle="tab" 
                                data-bs-target="#etudiant" type="button" role="tab" 
                                aria-controls="etudiant" aria-selected="true">
                            <i class="fas fa-user-graduate me-2"></i>Étudiant
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admin-tab" data-bs-toggle="tab" 
                                data-bs-target="#admin" type="button" role="tab" 
                                aria-controls="admin" aria-selected="false">
                            <i class="fas fa-user-shield me-2"></i>Administrateur
                        </button>
                    </li>
                </ul>

                <!-- Contenu des onglets -->
                <div class="tab-content" id="authTabsContent">
                    
                    <!-- Onglet Étudiant -->
                    <!-- Onglet Étudiant -->
                    <div class="tab-pane fade show active" id="etudiant" role="tabpanel" aria-labelledby="etudiant-tab">
                        <form id="loginEtudiantForm">
                            <div id="etudiant-message"></div>
                            
                            <div class="mb-3">
                                <label for="identifiant" class="form-label">CNE ou Code Massar</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="identifiant" name="identifiant" 
                                           placeholder="Votre CNE ou Code Massar" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="cin" class="form-label">CIN</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                    <input type="text" class="form-control" id="cin" name="cin" 
                                           placeholder="Votre numéro CIN" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-auth w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                            </button>
                            
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    Utilisez votre CNE/Code Massar et CIN pour vous connecter
                                </small>
                            </div>
                        </form>
                    </div>

                    <!-- Onglet Administrateur -->
                    <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                        <form id="loginAdminForm">
                            <div id="admin-message"></div>
                            
                            <div class="mb-3">
                                <label for="login" class="form-label">Login</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="login" name="login" 
                                           placeholder="Votre login administrateur" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="motdepasse" class="form-label">Mot de passe</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="motdepasse" name="motdepasse" 
                                           placeholder="Votre mot de passe" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-auth w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                            </button>
                            
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    Accès réservé aux administrateurs
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript personnalisé -->
    <script>
        // Définir BASE_URL
        const BASE_URL = '<?= base_url() ?>';

        // Gestion de la connexion étudiant
        document.getElementById('loginEtudiantForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const identifiant = document.getElementById('identifiant').value.trim();
            const cin = document.getElementById('cin').value.trim();
            const messageDiv = document.getElementById('etudiant-message');
            const submitBtn = this.querySelector('button[type="submit"]');
            
            if (!identifiant || !cin) {
                showMessage('Veuillez saisir votre CNE/Code Massar et CIN', 'error', messageDiv);
                return;
            }

            // Désactiver le bouton
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Connexion...';

            fetch(BASE_URL + 'auth/login_ajax', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ 
                    identifiant: identifiant,
                    cin: cin 
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage(data.message, 'success', messageDiv);
                    setTimeout(() => {
                        window.location.href = data.redirect || BASE_URL + 'dashboard';
                    }, 1000);
                } else {
                    showMessage(data.message, 'error', messageDiv);
                    if (data.clearFields) {
                        document.getElementById('identifiant').value = '';
                        document.getElementById('cin').value = '';
                    }
                }
            })
            .catch(err => {
                console.error('Erreur:', err);
                showMessage('Erreur de connexion au serveur', 'error', messageDiv);
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-sign-in-alt me-2"></i>Se connecter';
            });
        });

        // Gestion de la connexion admin
        document.getElementById('loginAdminForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const login = document.getElementById('login').value.trim();
            const motdepasse = document.getElementById('motdepasse').value.trim();
            const messageDiv = document.getElementById('admin-message');
            const submitBtn = this.querySelector('button[type="submit"]');
            
            if (!login || !motdepasse) {
                showMessage('Veuillez remplir tous les champs', 'error', messageDiv);
                return;
            }
            
console.log('BASE_URL:', BASE_URL);
console.log('URL complète:', BASE_URL + 'auth/login_admin_ajax');
console.log('Données envoyées:', { login: login, motdepasse: motdepasse });
            
            // Désactiver le bouton
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Connexion...';

            fetch(BASE_URL + 'auth/login_admin_ajax', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ login: login, motdepasse: motdepasse })
            })
            
    .then(response => {
        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }
        return response.json();
    })
            
   
   
            
.then(data => {
    console.log('Réponse complète du serveur:', data);
    
    if (data.success) {
        console.log('SUCCÈS - Redirection vers:', data.redirect);
        showMessage(data.message, 'success', messageDiv);
        
        // FORCER la redirection après 1 seconde
        setTimeout(() => { 
            console.log('Exécution de la redirection vers:', data.redirect);
            window.location.href = data.redirect; 
        }, 1000);
    } else {
        console.log('ERREUR:', data.message);
        showMessage(data.message, 'error', messageDiv);
    }
})
.catch(err => {
    console.error('Erreur fetch complète:', err);
    showMessage('Erreur de connexion au serveur: ' + err.message, 'error', messageDiv);
})
            
            
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-sign-in-alt me-2"></i>Se connecter';
            });
        });

        // Fonction pour afficher les messages
        function showMessage(message, type, container) {
            container.innerHTML = `
                <div class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            // Auto-dismiss après 5 secondes
            setTimeout(() => {
                const alert = container.querySelector('.alert');
                if (alert) {
                    alert.remove();
                }
            }, 5000);
        }

        // Reset des messages quand on change d'onglet
        document.getElementById('authTabs').addEventListener('show.bs.tab', function(e) {
            document.getElementById('etudiant-message').innerHTML = '';
            document.getElementById('admin-message').innerHTML = '';
        });
    </script>
</body>
</html>