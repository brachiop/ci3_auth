// assets/js/login.js
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

    console.log('Tentative de connexion étudiant:', { identifiant, cin });
    console.log('URL:', BASE_URL + 'auth/login_ajax');

    fetch(BASE_URL + 'auth/login_ajax', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ 
            identifiant: identifiant,
            cin: cin 
        })
    })
    .then(response => {
        console.log('Statut HTTP:', response.status, response.statusText);
        if (!response.ok) {
            throw new Error(`Erreur HTTP: ${response.status} ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Réponse serveur:', data);
        
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
                document.getElementById('identifiant').focus();
            }
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