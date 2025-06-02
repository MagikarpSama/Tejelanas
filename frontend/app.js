const API_BASE = 'http://localhost/tejelanas/backend/api/proxy.php?endpoint=';

const app = Vue.createApp({
  data() {
    return {
      currentPage: 'home',
      services: [],
      aboutUs: {},
      faqs: [],
      selectedProduct: '',
      swiperInstance: null
    }
  },
  methods: {
  openContact(productName) {
    this.selectedProduct = productName; 
    const contactSection = document.querySelector('#contact');
    if (contactSection) {
      contactSection.scrollIntoView({ behavior: 'smooth' }); 
    }
  },
    async fetchServices() {
      try {
        const res = await fetch(API_BASE + 'products-services');
        if (!res.ok) throw new Error('No se pudo cargar servicios');
        const data = await res.json();
        this.services = Array.isArray(data.data?.productos)
          ? data.data.productos.map(s => ({
            ...s,
            imagen: Array.isArray(s.imgs) && s.imgs.length > 0 ? s.imgs[0] : '',
          }))
          : [];
      } catch (err) {
        alert('Error cargando servicios: ' + err.message);
        this.services = [];
      }
    },
    async fetchAboutUs() {
      try {
        const res = await fetch(API_BASE + 'about-us');
        if (!res.ok) throw new Error('No se pudo cargar información');
        const data = await res.json();
        if (typeof data.data === 'string') {
          let desc = data.data;
          if (desc.startsWith('"') && desc.endsWith('"')) {
            desc = desc.slice(1, -1);
          }
          this.aboutUs = { descripcion: desc };
        } else {
          this.aboutUs = data.data;
        }
      } catch (err) {
        alert('Error cargando información: ' + err.message);
        this.aboutUs = {};
      }
    },
    async fetchFaqs() {
      try {
        const res = await fetch(API_BASE + 'faq');
        if (!res.ok) throw new Error('No se pudo cargar FAQs');
        const data = await res.json();
        this.faqs = Array.isArray(data.data) ? data.data : [];
      } catch (err) {
        alert('Error cargando FAQs: ' + err.message);
        this.faqs = [];
      }
    },
    initializeSwiper() {
      if (this.services.length > 0 && typeof Swiper !== 'undefined') {
        console.log("Intentando inicializar Swiper...");

        if (this.swiperInstance) {
          this.swiperInstance.destroy(true, true);
          this.swiperInstance = null; 
          console.log("Instancia de Swiper destruida.");
        }

        const swiperElement = document.querySelector('.blog-slider');
        if (swiperElement) {
          this.swiperInstance = new Swiper('.blog-slider', {
            spaceBetween: 30,
            effect: 'fade',
            loop: true,
            mousewheel: {
              invert: false,
            },
            pagination: {
              el: '.blog-slider__pagination',
              clickable: true,
            },
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            },
            autoplay: {
              delay: 5000,
              disableOnInteraction: false,
            },
          });
          console.log("Swiper inicializado correctamente.");
        } else {
          console.warn("Elemento .blog-slider no encontrado en el DOM para inicializar Swiper.");
        }
      } else {
        console.warn("No se pudo inicializar Swiper: servicios no cargados o Swiper no disponible.");
      }
    },
    formatDate(date) {
      return date;
    }
  },
  mounted() {
    this.fetchServices();
    this.fetchAboutUs();
    this.fetchFaqs();

this.$nextTick(() => {
  const navLinks = document.querySelectorAll('.navbar-nav .nav-link[href^="#"]');
  const sections = Array.from(navLinks).map(link => document.querySelector(link.getAttribute('href')));
  const offset = 80; 

  function onScroll() {
    let scrollPos = window.scrollY || window.pageYOffset;
    let found = false;
    sections.forEach((section, i) => {
      if (!section) return;
      const top = section.offsetTop - offset;
      const bottom = top + section.offsetHeight;
      if (scrollPos >= top && scrollPos < bottom) {
        navLinks.forEach(link => link.classList.remove('active'));
        navLinks[i].classList.add('active');
        found = true;
      }
    });
    // Si no se encontró ninguna sección activa y estamos al final de la página, activa el último enlace (Contacto)
    if (!found && (window.innerHeight + scrollPos >= document.body.scrollHeight - 2)) {
      navLinks.forEach(link => link.classList.remove('active'));
      navLinks[navLinks.length - 1].classList.add('active');
    }
  }

  window.addEventListener('scroll', onScroll);
  onScroll();
});
  },
  watch: {
    currentPage(newVal, oldVal) {
      if (newVal === 'home') {
        this.$nextTick(() => {
          if (this.services.length > 0) {
            this.initializeSwiper();
          } else {
            console.log("Esperando a que los servicios se carguen para inicializar Swiper al volver a 'home'.");
          }
        });
      } else {
        if (this.swiperInstance) {
          this.swiperInstance.destroy(true, true);
          this.swiperInstance = null;
          console.log("Swiper destruido al salir de 'home'.");
        }
      }
    },
    services() {
      if (this.currentPage === 'home' && this.services.length > 0) {
        this.$nextTick(() => {
          this.initializeSwiper();
        });
      }
    }
  }
});

app.mount('#app');