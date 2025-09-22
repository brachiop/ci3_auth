// assets/js/login_admin.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('admin-login-form');
    const messageDiv = document.getElementById('login-message');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const login = document.getElementById('login').value.trim();
        const motdepasse = document.getElementById('motdepasse').value.trim();

        if (!login || !motdepasse) {
            messageDiv.textContent = 'Veuillez remplir tous les champs.';
            return;
        }

        fetch(BASE_URL + 'auth/login_admin_ajax', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ login, motdepasse })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                messageDiv.classList.remove('text-danger');
                messageDiv.classList.add('text-success');
                messageDiv.textContent = data.message;
                setTimeout(() => { window.location.href = BASE_URL + 'admin/dashboard_admin'; }, 1000);
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
