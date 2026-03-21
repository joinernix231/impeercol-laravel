document.addEventListener("DOMContentLoaded", function(){
  // El navbar actual (imp-nav) gestiona el scroll con su propio JS.
  // Este script solo actúa si existe el elemento legacy #navbar_top.
  var navbarTop = document.getElementById('navbar_top');
  if (!navbarTop) return;

  window.addEventListener('scroll', function() {
    var navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
      navbarTop.classList.add('fixed-top');
      if (navbar) document.body.style.paddingTop = navbar.offsetHeight + 'px';
    } else {
      navbarTop.classList.remove('fixed-top');
      document.body.style.paddingTop = '0';
    }
  });
});