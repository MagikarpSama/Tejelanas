app.component('faq-list', {
  props: ['faqs'],
  template: `
    <div class="container my-5">
      <div class="card faq-card shadow-lg mx-auto" style="max-width: 700px;">
        <div class="card-body">
          <h2 class="card-title mb-4 text-center">Preguntas frecuentes</h2>
          <div v-if="faqs.length > 0">
            <div class="accordion" id="faqAccordion">
              <div class="accordion-item" v-for="(faq, i) in faqs" :key="i">
                <h2 class="accordion-header" :id="'heading' + i">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    :data-bs-target="'#collapse' + i" aria-expanded="false" :aria-controls="'collapse' + i">
                    {{ faq.titulo }}
                  </button>
                </h2>
                <div :id="'collapse' + i" class="accordion-collapse collapse" :aria-labelledby="'heading' + i"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    {{ faq.respuesta }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-else class="text-muted text-center">No hay preguntas frecuentes disponibles.</div>
        </div>
      </div>
    </div>
  `
});