document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('login-form');
    const messageDiv = document.getElementById('login-message');

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Empêche le rechargement de page

        const formData = new FormData(form);
        const data = {
            username: formData.get('username'),
            password: formData.get('password')
        };

        messageDiv.textContent = 'Connexion en cours...';
        messageDiv.classList.remove('text-success', 'text-danger');

        fetch(BASE_URL + 'auth/login_ajax', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(json => {
            if(json.success){
                messageDiv.classList.add('text-success');
                messageDiv.textContent = 'Connexion réussie ! Redirection...';
                setTimeout(() => window.location.href = BASE_URL + 'dashboard', 1000);
            } else {
                messageDiv.classList.add('text-danger');
                messageDiv.textContent = json.message;

                // Vider les champs si flag clearFields
                if(json.clearFields){
                    const usernameInput = document.getElementById('username');
                    const passwordInput = document.getElementById('password');
                    if(usernameInput) usernameInput.value = '';
                    if(passwordInput) passwordInput.value = '';
                    if(usernameInput) usernameInput.focus();
                }
            }
        })
        .catch(err => {
            messageDiv.classList.add('text-danger');
            messageDiv.textContent = 'Erreur réseau, réessayez.';
        });
    });
});
