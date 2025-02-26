<section class="py-5" style="background-image: url('images/imagen22(grande).jpeg');background-repeat: no-repeat;background-size: cover;">
      <div class="container-fluid">

        <div class="bg-secondary py-5 my-5 rounded-5" style="background-color:rgba(255,255,255,0.9) !important">
          <div class="container my-5">
            <div class="row">
              <div class="col-md-7 p-5">
                <div class="section-header">
                  <h1 class="sdisplay-4"> 
                    

                  ¿Tienes un <span style="color:#ffca42 !important ">PROYECTO, UN DESARROLLO INMOBILIARIO O</span>  eres <span style="color:#ffca42 !important ">
                    CONSTRUCTOR INDEPENDIENTE? </span>

Contáctanos, tenemos beneficios exclusivos para ti.

                  </span></h1>

                </div>
                
              </div>
              <div class="col-md-5 p-5">
              <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Escribe tu nombre..." required>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Email / Teléfono</label>
                    <input type="text" class="form-control form-control-lg" name="contact" id="contact" placeholder="Escribe tu contacto..." required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Mensaje</label>
                    <textarea class="form-control form-control-lg" name="message" id="message" rows="4" placeholder="Escribe tu mensaje..." required></textarea>
                </div>
                <div class="form-check form-check-inline mb-3">
                    <input class="form-check-input" type="checkbox" id="subscribe" name="subscribe" value="1">
                    <label class="form-check-label" for="subscribe">Suscribirte a nuestro newsletter</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark btn-lg">Enviar</button>
                </div>
            </form>

                
              </div>
              
            </div>
            
          </div>
        </div>
        
      </div>
    </section>
	