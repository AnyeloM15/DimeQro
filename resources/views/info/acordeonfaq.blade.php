<section class="py-5 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-header mb-5">
                    <h2 class="section-title " >
                        Preguntas Frecuentes
                    </h2>
                  
                </div>

                <div class="accordion" id="faqAccordion">
                    @foreach(DB::table('faqs')->get() as $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false"
                                    aria-controls="collapse{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> <!-- Fin del acordeón -->
            </div>
        </div>
    </div>
</section>
