// assets/js/login.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('login-form');
    const messageDiv = document.getElementById('login-message');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();

        if (!username || !password) {
            messageDiv.textContent = 'Veuillez remplir tous les champs.';
            return;
        }

        fetch(BASE_URL + 'auth/login_ajax', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, password })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                messageDiv.classList.remove('text-danger');
                messageDiv.classList.add('text-success');
                messageDiv.textContent = data.message;
                // Redirection après 1 seconde
                setTimeout(() => { window.location.href = BASE_URL + 'dashboard'; }, 1000);
            } else {
                messageDiv.classList.remove('text-success');
                messageDiv.classList.add('text-danger');
                messageDiv.textContent = data.message;
                if (data.clearFields) {
                    form.reset();
                }
            }
        })
        .catch(err => {
            console.error(err);
            messageDiv.textContent = 'Erreur serveur, veuillez réessayer.';
        });
    });
});
