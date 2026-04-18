(function() {
  "use strict";
    
  //Mobile nav toggle

  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  //Toggle mobile nav dropdowns

  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {

    navmenu.addEventListener('click', function(e) {
        
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
      
    });
    
  });
    
  //Preloader
  const preloader = document.querySelector('#preloader');
    
  if (preloader) {
      
    window.addEventListener('load', () => {
        
      preloader.remove();
      
    });
    
  }
    
    
  //Scroll top button
      
  let scrollTop = document.querySelector('.scroll-top');
    
  function toggleScrollTop() {
      
    if (scrollTop) {
        
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
      
    }
    
  }
 
  scrollTop.addEventListener('click', (e) => {
      
    e.preventDefault();
      
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
    
  });
    
  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);
    
  //Animation on scroll function and init

  function aosInit() {
      
    AOS.init({
      duration: 600,
      /*easing: 'ease-in-out',*/
      once: true,
      mirror: false
    });

  }
    
  window.addEventListener('load', aosInit);
    
  //Auto generate the carousel indicators
      
  document.querySelectorAll('.carousel-indicators').forEach((carouselIndicator) => {

    carouselIndicator.closest('.carousel').querySelectorAll('.carousel-item').forEach((carouselItem, index) => {
        
      if (index === 0) {
        carouselIndicator.innerHTML += `<li data-bs-target="#${carouselIndicator.closest('.carousel').id}" data-bs-slide-to="${index}" class="active"></li>`;
      } else {
        carouselIndicator.innerHTML += `<li data-bs-target="#${carouselIndicator.closest('.carousel').id}" data-bs-slide-to="${index}"></li>`;
      }

    });

  });
    
  //Initiate glightbox
    
  const glightbox = GLightbox({
    selector: '.glightbox'
  });
    
  //Init isotope layout and filters
    
  document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {

    let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
    let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
    let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';
    
    let initIsotope;
    imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {

      initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
        itemSelector: '.isotope-item',
        layoutMode: layout,
        filter: filter,
        sortBy: sort
      });

    });
    
    isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
 
      filters.addEventListener('click', function() {
          
        isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
        this.classList.add('filter-active');
        initIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        if (typeof aosInit === 'function') {
          aosInit();
        }

      }, false);

    });
    
  });
    
  //Init swiper sliders
    
  function initSwiper() {
      
    document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
        
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );
    
      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
      
    });
    
  }
    
  window.addEventListener("load", initSwiper);
    
  //Correct scrolling position upon page load for URLs containing hash links.

  window.addEventListener('load', function(e) {
      
    if (window.location.hash) {
        
      if (document.querySelector(window.location.hash)) {
          
        setTimeout(() => {
            
          let section = document.querySelector(window.location.hash);
          let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
          window.scrollTo({
            top: section.offsetTop - parseInt(scrollMarginTop),
            behavior: 'smooth'
          });
          
        }, 100);
        
      }
    }
    
  });
    
  //Navmenu Scrollspy
      
  let navmenulinks = document.querySelectorAll('.navmenu a');
    
  function navmenuScrollspy() {

    navmenulinks.forEach(navmenulink => {
        
      if (!navmenulink.hash) return;
      let section = document.querySelector(navmenulink.hash);
      if (!section) return;
      let position = window.scrollY + 200;
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        document.querySelectorAll('.navmenu a.active').forEach(link => link.classList.remove('active'));
        navmenulink.classList.add('active');
      } else {
        navmenulink.classList.remove('active');
      }
      
    })
    
  }

  window.addEventListener('load', navmenuScrollspy);
    
  document.addEventListener('scroll', navmenuScrollspy);
      
  // Validation du formulaire  /*registration*/
       
  document.getElementById('button').addEventListener('submit', function(event) {
            
    event.preventDefault(); // Empêche la soumission du formulaire par défaut
    const identifiant = document.getElementById('identifiant').value;
    const password = document.getElementById('password').value;
        
    // Vérification de la validation des champs
    if (!identifiant || !password) {
      document.getElementById('errorMessage').textContent = 'Tous les champs doivent être remplis.';
    } else if (!validateEmail(identifiant)) {
      document.getElementById('errorMessage').textContent = 'Veuillez entrer un identifiant valide.';
    } else if (!validatePassword(password)) {// Validation du mot de passe
      document.getElementById('errorMessage').textContent = 'Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule et un chiffre.';
    } else {
      document.getElementById('errorMessage').textContent = '';
      // Si toutes les validations passent, soumettre le formulaire
      alert('Inscription réussie');
      // Ici, tu peux ajouter la logique pour envoyer les données au serveur (via AJAX ou formulaire classique)
    }
        
  });
        
  // Fonction pour valider l'email
  function validateIdentifiant(identifiant) {
    
    // Doit commencer par des lettres, inclure 0 à 2 chiffres n'importe où, et contenir uniquement lettres et chiffres
    const re = /^[a-zA-Z]+[a-zA-Z]*\d{0,2}$/;
    return re.test(identifiant);
  }
       
  // Fonction pour valider le mot de passe
  function validatePassword(password) {
            
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/; // Au moins 8 caractères, 1 majuscule, 1 minuscule, 1 chiffre
    return re.test(password);
        
  }

  function submitForm(event) {
            
    event.preventDefault(); // Empêche l'envoi classique du formulaire
        
    const formData = new FormData(document.getElementById('registrationForm'));
        
    fetch('/store', {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.message) {
        window.location.href = 'conAssociation'; // Redirection en cas de succès
      }
    })
    .catch(error => console.error('Erreur:', error));
  }
  
})();