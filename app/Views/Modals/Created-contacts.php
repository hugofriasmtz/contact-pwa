<form id="formAccountSettings" method="POST" enctype="multipart/form-data">
  <div class="card-body">
    <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
      <img src="../../../assets/img/avatars/1.png" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
      <div class="button-wrapper">
        <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
          <span class="d-none d-sm-block">Foto del contacto</span>
          <i class="bx bx-upload d-block d-sm-none"></i>
          <input type="file" name="profile_picture" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
        </label>
        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
          <i class="bx bx-reset d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Quitar</span>
        </button>

        <div>Formato JPG or PNG. Tamaño maximo 800K</div>
      </div>
    </div>
  </div>
  <div class="card-body pt-4">
    <div class="row g-6">
      <div class="form-floating col-md-6">
        <input type="text" class="form-control" name="names" id="floatingInput" placeholder="Hugo" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Nombre</label>
      </div>
      <div class="form-floating col-md-6">
        <input type="text" class="form-control" name="last_names" id="floatingInput" placeholder="Frías" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Apellido</label>
      </div>
      <div class="form-floating col-md-4">
        <input type="tel" class="form-control" name="phone_number" id="floatingInput" placeholder="2382582525" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Teléfono</label>
      </div>
      <div class="form-floating col-md-4">
        <input type="email" class="form-control" name="email" id="floatingInput" placeholder="contacto@dominio.com" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Correo</label>
      </div>
      <div class=" col-md-4">
        <select name="category" id="largeSelect" class="form-select form-select-lg">
          <option>Contacto</option>
          <option value="PERSONAL">Personal</option>
          <option value="WORK">Trabajo</option>
          <option value="FRIEND">Amigo</option>
          <option value="HOME">Casa</option>
          <option value="OFFICE">Oficina</option>
      </div>

      <div class="form-floating col-md-4">
        <input type="text" class="form-control" name="company" id="floatingInput" placeholder="Sam´s" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Trabajo</label>
      </div>
      <div class="form-floating col-md-4">
        <input type="text" class="form-control" name="position" id="floatingInput" placeholder="Gerente" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Cargo</label>
      </div>
      <div class="form-floating col-md-4">
        <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="birth_date" id="floatingInput" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Cumpleaños</label>
      </div>
      <div class="form-floating col-md-4">
        <input type="text" class="form-control" name="street" id="floatingInput" placeholder="Miguel" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Calle</label>
      </div>
      <div class="form-floating col-md-2">
        <input type="text" class="form-control" name="number_ext" id="floatingInput" placeholder="1500" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Numero Ext</label>
      </div>
      <div class="form-floating col-md-2">
        <input type="text" class="form-control" name="number_int" id="floatingInput" placeholder="A" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Numero Int</label>
      </div>
      <div class="form-floating col-md-4">
        <input type="text" class="form-control" name="neighborhood" id="floatingInput" placeholder="America" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Colonia</label>
      </div>
      <div class="form-floating col-md-6">
        <input type="text" class="form-control" name="city" id="floatingInput" placeholder="Tehuacán" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Cuidad</label>
      </div>
      <div class="form-floating col-md-6">
        <input type="text" class="form-control" name="state" id="floatingInput" placeholder="Puebla" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Estado</label>
      </div>
      <div class="form-floating col-md-6">
        <input type="text" class="form-control" name="postal_code" id="floatingInput" placeholder="75000" aria-describedby="floatingInputHelp" />
        <label for="floatingInput">Código Postal</label>
      </div>
      <div class=" col-md-6">
        <select name="address_type" id="largeSelect" class="form-select form-select-lg">
          <option>Tipo de vivienda</option>
          <option value="HOUSE">Casa</option>
          <option value="APARTMENT">Apartamento</option>
          <option value="STUDY">Estudio</option>
          <option value="BUSINESSW">Negocio</option>
      </div>

      <div class="col-md-12">
        <label for="exampleFormControlTextarea1" class="form-label">Notas</label>
        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>

      <div class="mt-6">
        <button type="submit" class="btn btn-success me-3">Guardar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
      </div>

    </div>
</form>