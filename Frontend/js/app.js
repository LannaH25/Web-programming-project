$(function () {
    const app = $.spapp({
        defaultView: "#home",
        templateDir: "",
    });
    app.run();
});

document.addEventListener('click', function (e) {
    const btn = e.target.closest('.favorite-btn');
    if (!btn) return;
    btn.classList.toggle('liked');
});

const navLinks = document.querySelectorAll('#nav a');
function setActiveLink(hash) {
    navLinks.forEach(link => link.classList.remove('current'));
    const activeLink = document.querySelector(`#nav a[href="${hash}"]`);
    if (activeLink) activeLink.classList.add('current');
}
setActiveLink(window.location.hash || '#home');
window.addEventListener('hashchange', () => setActiveLink(window.location.hash));

const loginForm = document.getElementById('login-form');
loginForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = loginForm.querySelector('#email').value.trim();
    const password = loginForm.querySelector('#password').value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!email || !emailRegex.test(email)) { alert("Please enter a valid email"); return; }
    if (!password) { alert("Password is required"); return; }
});

const registerForm = document.getElementById('register-form');
registerForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const name = registerForm.querySelector('#name').value.trim();
    const email = registerForm.querySelector('#email').value.trim();
    const password = registerForm.querySelector('#password').value.trim();
    const confirm = registerForm.querySelector('#confirm-password').value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{6,}$/;

    if (!name) { alert("Name is required"); return; }
    if (!email || !emailRegex.test(email)) { alert("Valid email required"); return; }
    if (!password || !passwordRegex.test(password)) {
        alert("Password must be at least 6 characters and include uppercase, lowercase, number, and special character.");
        return;
    }
    if (password !== confirm) { alert("Passwords do not match"); return; }

});

const contactForm = document.querySelector('.contact-form');
contactForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const name = contactForm.querySelector('#name').value.trim();
    const email = contactForm.querySelector('#email').value.trim();
    const message = contactForm.querySelector('#message').value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!name || !email || !message) { alert("All fields are required"); return; }
    if (!emailRegex.test(email)) { alert("Enter a valid email"); return; }

});
