$(function () {
  var app = $.spapp({
    defaultView: "#home",   
    templateDir: "",       
  });

  app.run();
});



  document.addEventListener('click', function(e) {
    if (e.target.closest('.favorite-btn')) {
      const btn = e.target.closest('.favorite-btn');
      btn.classList.toggle('liked');
    }
  });



  const navLinks = document.querySelectorAll('#nav a');

function setActiveLink(hash) {
  navLinks.forEach(link => link.classList.remove('current'));
  const activeLink = document.querySelector(`#nav a[href="${hash}"]`);
  if(activeLink) activeLink.classList.add('current');
}

setActiveLink(window.location.hash || '#home');

window.addEventListener('hashchange', () => {
  setActiveLink(window.location.hash);
});
document.addEventListener('submit', function (e) {
    if (!e.target || e.target.id !== 'login-form') return;

    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    fetch('/backend/auth/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password })
    })
    .then(res => res.json())
    .then(data => {
        if (data.data?.token) {
            localStorage.setItem('token', data.data.token);
            alert('Login successful');
            window.location.hash = '#home';
        } else {
            alert(data.error || 'Login failed');
        }
    })
    .catch(() => alert('Server error'));

  });
