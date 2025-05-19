 <div class="form-control mb-3 d-flex flex-column p-3">
     <label for="name">Nome del videogioco*</label>
     <label for="name" id="input-info">min. 2 max. 50 caratteri</label>
     <div class="d-flex align-items-center position-relative">
         <span class="position-absolute ps-2">
             <i class="fa-solid fa-gamepad"></i>
         </span>
         <input type="text" name="name" id="name" value="{{ $name }}"
             placeholder="Inserisci quì il nome del videogioco" class="form-control pr-5 bg-white ps-5 pe-5"
             oninput="toggleClearButton('name')" />
         <span id="clear-btn-name" class="position-absolute end-0 pe-3" style="cursor: pointer"
             onclick="clearInput('name')">
             <i class="fas fa-times"></i>
         </span>
     </div>
     @error('name')
         <small class="text-danger">{{ $message }}</small>
     @enderror
 </div>
