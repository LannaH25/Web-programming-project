import AuthService from "../services/AuthService.js";

document.addEventListener('submit', function (e) {
  if (e.target.id !== 'login-form') return;

  e.preventDefault();

  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  AuthService.login(email, password)
    .then(data => {
      if (data.data?.token) {
        localStorage.setItem('token', data.data.token);
        window.location.hash = '#home';
      } else {
        alert(data.error || 'Login failed');
      }
    })
    .catch(() => alert('Server error'));
});

document.addEventListener('submit', function (e) {
  if (e.target.id !== 'register-form') return;

  e.preventDefault();

  const user = {
    full_name: document.getElementById('name').value,
    email: document.getElementById('email').value,
    password: document.getElementById('password').value
  };

  AuthService.register(user)
    .then(() => {
      alert('Registration successful');
      window.location.hash = '#login';
    })
    .catch(() => alert('Registration failed'));
});
