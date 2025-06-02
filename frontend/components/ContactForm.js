app.component('contact-form', {
  props: ['product'],
  data() {
    return {
      nombre: '',
      teléfono: '',
      email: '',
      mensaje: '',
      producto: this.product || '',
      enviado: false,
      error: ''
    }
  },
  watch: {
    product(newVal) {
      this.producto = newVal;
    }
  },
  methods: {
    enviar() {
      if (!this.nombre || !this.email || !this.mensaje) {
        this.error = 'Por favor, completa todos los campos.';
        return;
      }
      this.enviado = true;
      this.error = '';
    }
  },
  template: `
    <div class="container my-5 d-flex justify-content-center">
      <div class="card shadow-lg contact-card" style="max-width: 500px; width: 100%;">
        <div class="card-body">
          <h2 class="card-title mb-4 text-center">Contáctanos</h2>
          <form @submit.prevent="enviar" v-if="!enviado">
            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" v-model="nombre" class="form-control" required />
            </div>
            <div class="mb-3">
      <label for="telefono" class="form-label">Teléfono</label>
      <input type="tel" class="form-control" id="telefono" v-model="telefono" placeholder="Ej: +56912345678" required>
    </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" v-model="email" class="form-control" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Producto</label>
              <input type="text" v-model="producto" class="form-control" readonly />
            </div>
            <div class="mb-3">
              <label class="form-label">Mensaje</label>
              <textarea v-model="mensaje" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-danger w-100">Enviar</button>
            <p v-if="error" class="text-danger mt-2 text-center">{{ error }}</p>
          </form>
          <div v-else class="text-center">
            <p class="fs-5 mb-0">¡Gracias por contactarnos! Te responderemos pronto.</p>
          </div>
        </div>
      </div>
    </div>
  `
});