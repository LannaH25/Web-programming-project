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
