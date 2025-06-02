app.component('about-us', {
  props: ['info'],
  template: `
    <div class="container my-5 d-flex justify-content-center">
      <div class="card aboutus-card shadow-lg" style="max-width: 700px; width: 100%;">
        <div class="card-body">
          <h2 class="card-title mb-3 text-center">¿Quiénes somos?</h2>
          <hr class="mx-auto" style="width: 60px; border-top: 3px solid #fd3838;">
          <p class="card-text fs-5 mt-4" v-if="info.descripcion">{{ info.descripcion }}</p>
          <div v-else class="text-muted text-center">Cargando información...</div>
        </div>
      </div>
    </div>
  `
});