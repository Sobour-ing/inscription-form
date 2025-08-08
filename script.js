document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registrationForm');

    // Fonction pour valider un champ 
    function validateField(fieldId) {
        const value = document.getElementById(fieldId).value.trim();
        const errorSpan = document.getElementById(fieldId + 'Error');
        let errorMessage = '';

        switch(fieldId) {
            case 'nom':
            case 'prenom':
                if (value === '') {
                    errorMessage = `Veuillez entrer votre ${fieldId === 'nom' ? 'nom' : 'prénom'}`;
                }
                break;

            case 'email':
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (value === '') {
                    errorMessage = 'Veuillez entrer votre adresse email';
                } else if (!emailRegex.test(value)) {
                    errorMessage = 'Adresse email invalide';
                }
                break;

            case 'password':
                if (value === '') {
                    errorMessage = 'Veuillez entrer un mot de passe';
                } else if (value.length < 8) {
                    errorMessage = 'Le mot de passe doit contenir au moins 8 caractères';
                }
                break;

            case 'confirmpassword':
                const passwordValue = document.getElementById('password').value;
                if (value === '') {
                    errorMessage = 'Veuillez confirmer le mot de passe';
                } else if (value !== passwordValue) {
                    errorMessage = 'Les mots de passe ne correspondent pas';
                }
                break;
        }

        errorSpan.textContent = errorMessage;
        return errorMessage === ''; // true = valide, false = erreur
    }

    // Validation en direct au fur et à mesure que je saisis
    ['nom', 'prenom', 'email', 'password', 'confirmpassword'].forEach(id => {
        document.getElementById(id).addEventListener('input', function () {
            validateField(id);
        });
    });

    // Validation checkbox à chaque modif
    document.getElementById('terms').addEventListener('change', function () {
        const termsError = document.getElementById('termsError');
        termsError.textContent = this.checked ? '' : 'Vous devez accepter les conditions';
    });

    // Validation complète au submit
    form.addEventListener('submit', function (e) {
        let isValid = true;

        // Réinitialiser tous les messages d'erreur
        document.querySelectorAll('.error').forEach(span => span.textContent = '');
        document.getElementById('success-message').textContent = '';
        document.getElementById('success-message').style.color = '';

        // Valider tous les champs
        ['nom', 'prenom', 'email', 'password', 'confirmpassword'].forEach(id => {
            if (!validateField(id)) {
                isValid = false;
            }
        });

        // Valider la case à cocher
        if (!document.getElementById('terms').checked) {
            document.getElementById('termsError').textContent = 'Vous devez accepter les conditions';
            isValid = false;
        }

        // Si pas valide, empêcher la soumission du form.
        if (!isValid) {
            e.preventDefault();
            return false;
        }

        // Si tout est OK, laisse le formulaire se soumettre normalement
        // Le PHP fait la redirection
    });
});
