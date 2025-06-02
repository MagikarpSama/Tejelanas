app.component('service-card', {
  props: ['image', 'title', 'description'],
  emits: ['contact'],
  template: `
    <div class="service-card" tabindex="0" aria-label="Servicio: {{ title }}">
      <img :src="image" :alt="title" class="service-card__image" />
      <div class="service-card__content">
        <h3>{{ title }}</h3>
        <p>{{ description }}</p>
        <button @click="$emit('contact')" aria-label="Contáctanos por {{ title }}">
          Contáctanos
        </button>
      </div>
    </div>
  `
});