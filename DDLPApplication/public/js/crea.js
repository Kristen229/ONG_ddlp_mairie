(function(){
    "use strict"
    
    /**
      * Apply .scrolled class to the body as the page is scrolled down
    */
    function toggleScrolled() {
      const selectBody = document.querySelector('body');
      const selectHeader = document.querySelector('#header');
      if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
      window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
    }
    
    document.addEventListener('scroll', toggleScrolled);
    window.addEventListener('load', toggleScrolled);
    
    /**
      * Mobile nav toggle
    */
    const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');
    
    function mobileNavToogle() {
      document.querySelector('body').classList.toggle('mobile-nav-active');
      mobileNavToggleBtn.classList.toggle('bi-list');
      mobileNavToggleBtn.classList.toggle('bi-x');
    }
    mobileNavToggleBtn.addEventListener('click', mobileNavToogle);
    
    /**
      * Hide mobile nav on same-page/hash links
    */
    document.querySelectorAll('#navmenu a').forEach(navmenu => {
      navmenu.addEventListener('click', () => {
        if (document.querySelector('.mobile-nav-active')) {
          mobileNavToogle();
        }
      });
    
    });
    
    /**
      * Toggle mobile nav dropdowns
      */
    document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
      navmenu.addEventListener('click', function(e) {
        e.preventDefault();
        this.parentNode.classList.toggle('active');
        this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
        e.stopImmediatePropagation();
      });
    });
    
    /**
      * Preloader
      */
    const preloader = document.querySelector('#preloader');
    if (preloader) {
      window.addEventListener('load', () => {
        preloader.remove();
      });
    }
    
    /**
      * Scroll top button
      */
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
    
    /**
      * Animation on scroll function and init
      */
    function aosInit() {
      AOS.init({
        duration: 600,
        /*easing: 'ease-in-out',*/
        once: true,
        mirror: false
      });
    }
    window.addEventListener('load', aosInit);
    
    /**
      * Auto generate the carousel indicators
      */
    document.querySelectorAll('.carousel-indicators').forEach((carouselIndicator) => {
      carouselIndicator.closest('.carousel').querySelectorAll('.carousel-item').forEach((carouselItem, index) => {
        if (index === 0) {
          carouselIndicator.innerHTML += `<li data-bs-target="#${carouselIndicator.closest('.carousel').id}" data-bs-slide-to="${index}" class="active"></li>`;
        } else {
          carouselIndicator.innerHTML += `<li data-bs-target="#${carouselIndicator.closest('.carousel').id}" data-bs-slide-to="${index}"></li>`;
        }
      });
    });
    
    /**
      * Initiate glightbox
      */
    const glightbox = GLightbox({
      selector: '.glightbox'
    });
    
    /**
      * Init isotope layout and filters
      */
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
    
    /**
      * Init swiper sliders
      */
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
    
    /**
      * Correct scrolling position upon page load for URLs containing hash links.
      */
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
    
    /**
      * Navmenu Scrollspy
      */
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
  
    // Gestionnaire pour les contrôles 'prev' et 'next'
    /*$('#associationONG-carousel').on('slide.bs.carousel', function (e) {
      var $activeItem = $('.carousel-item.active'); // Récupérer l'élément actif
      var $nextItem = $(e.relatedTarget); // Prochain élément à afficher
    
      // Réinitialiser les flex pour tous les items
      $('.carousel-item').css('flex', '0 0 25%');
    
      // Ajuster la largeur de l'élément actif (centré)
      $nextItem.css('flex', '0 0 50%');
    
      // Ajuster les voisins (si disponibles)
      if ($nextItem.next('.carousel-item').length) {
        $nextItem.next('.carousel-item').css('flex', '0 0 25%');
      }
      if ($nextItem.prev('.carousel-item').length) {
        $nextItem.prev('.carousel-item').css('flex', '0 0 25%');
      }
    });*/
  
    /*document.getElementById('learnMoreBtn').addEventListener('click', function(event) {
      event.preventDefault(); // Empêche l'action par défaut du bouton
      window.location.href = 'education'; // Redirige manuellement vers la page 'education'
    });*/
    
    function autoScroll() {
      const container = document.querySelector('.associationONG .associationONG-container .main-container');
      const items = document.querySelectorAll('.associationONG .associationONG-container .main-container .div');
      let index = 0;
  
      // Fonction pour défiler vers l'élément suivant
      function scrollNext() {
        // Calcule la position de défilement à atteindre pour l'élément suivant
        container.scrollTo({
          left: index * window.innerWidth, // Chaque div a une largeur égale à celle de la fenêtre
          behavior: 'smooth'
        });
  
        // Met à jour l'index pour aller au prochain élément
        index++;
  
        // Si l'index dépasse le nombre d'items, on revient au début
        if (index >= items.length) {
          index = 0;
        }
      }
  
      // Démarre le défilement toutes les 3 secondes
      setInterval(scrollNext, 3000); // Change l'item toutes les 3 secondes (modifiable)
    }
  
    // Démarrage du défilement automatique quand la page est prête
    window.onload = autoScroll;

    // Validation du formulaire
    document.getElementById('createAccountForm1').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche la soumission du formulaire par défaut
        const groupe = document.getElementById('groupe').value;
        const name = document.getElementById('name').value;
        const domaine = document.getElementById('domaine').value;
        const denomination = document.getElementById('denomination').value;
        const date = document.getElementById('date').value;
        const objectif1 = document.getElementById('objectif1').value;
        const objectif2 = document.getElementById('objectif2').value;
        const objectif3 = document.getElementById('objectif3').value;
    
        // Vérification de la validation des champs
        if (!groupe || !name || !domaine || !denomination ||!date ||!objectif1 ||!objectif2 ||!objectif3){
          document.getElementById('errorMessage').textContent = 'Tous les champs doivent être remplis.';
        } else if (!validateDate(date)) {
            document.getElementById('errorMessage').textContent = 'Veuillez entrer une date valide.';
        } else {
            document.getElementById('errorMessage').textContent = '';
          // Si toutes les validations passent, soumettre le formulaire
          alert('Inscription réussie');
          // Ici, tu peux ajouter la logique pour envoyer les données au serveur (via AJAX ou formulaire classique)
        }
    });
    
    function validateDate(dateString) {
        // Vérifie si le format correspond à JJ/MM/AAAA
        const regex = /^(\d{2})\/(\d{2})\/(\d{4})$/;
        const match = dateString.match(regex);
    
        if (!match) {
            return false; // Format incorrect
        }
    
        // Récupère les parties jour, mois et année de la date
        const day = parseInt(match[1], 10);
        const month = parseInt(match[2], 10);
        const year = parseInt(match[3], 10);
    
        // Vérifie si le mois est valide (entre 1 et 12)
        if (month < 1 || month > 12) {
            return false;
        }
    
        // Vérifie si le jour est valide en fonction du mois et de l'année
        const daysInMonth = new Date(year, month, 0).getDate();
        if (day < 1 || day > daysInMonth) {
            return false;
        }
    
        return true; // La date est valide
    }
    
    // Exemple d'utilisation
    console.log(validateDate("29/02/2024")); // true (année bissextile)
    console.log(validateDate("30/02/2023")); // false (février n'a que 28 jours)
    console.log(validateDate("31/04/2023")); // false (avril a 30 jours)
    console.log(validateDate("15/07/2023")); // true
    
    /*function submitFormType1(event) {
        event.preventDefault(); // Empêche l'envoi classique du formulaire
      
        const formData = new FormData(document.getElementById('createAccountForm1'));
      
        fetch('/crea', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                alert('Demande enregistrée avec succès');
                window.location.href = '/crea1'; // Redirection en cas de succès
            }
        })
        .catch(error => console.error('Erreur:', error));
    }

    document.getElementById('createAccountForm1').addEventListener('submit', submitFormType1);*/

})