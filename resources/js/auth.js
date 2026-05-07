// Alterna entre as abas Entrar / Cadastrar
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab');
    const forms = {
        login: document.getElementById('form-login'),
        register: document.getElementById('form-register'),
    };

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            tabs.forEach((t) => {
                t.classList.remove('active');
                t.setAttribute('aria-selected', 'false');
            });
            tab.classList.add('active');
            tab.setAttribute('aria-selected', 'true');

            Object.values(forms).forEach((f) => f.classList.remove('active'));
            forms[tab.dataset.tab].classList.add('active');
        });
    });
});
