<!-- Features Section Start -->
<section id="contact-form" class="section" data-stellar-background-ratio="0.2">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Zakazite fotografisanje</h2>
      <hr class="lines">
      <p class="section-subtitle">Unesite podatke u formu, a mi cemo Vas kontaktirati da se dogovorimo!</p>
    </div>
    <form method="post" id="shooting_sch" novalidate>
      @csrf
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-danger" id="form-errors" role="alert" style="display:none">
            Morate popuniti sva polja.
          </div>
          <div class="alert alert-success" id="form-success" role="alert" style="display:none">
            Uspesno ste poslali zahtev! Uskoro cemo Vas kontaktirati.
          </div>
        </div>
        <div class="form-group col-md-4">
          <input type="text" class="form-control" id="name" name="name" value="" placeholder="Vase ime i prezime" required>
        </div>
        <div class="form-group col-md-4">
          <input type="text" class="form-control" id="phone" name="phone" value="" placeholder="Broj telefona" onkeypress="return AllowNumbersOnly(event)" required>
        </div>
        <div class="form-group col-md-4">
          <input type="email" class="form-control" id="email" name="email" value="" placeholder="E-mail" required>
        </div>
        <div class="form-group col-md-6">
          <input type="text" required class="form-control" autocomplete="off" id="city" name="city" value="" placeholder="Mesto" onkeyup="return get_results()">
          <ul class="suggestions" style="display:none" id="suggestions">

          </ul>
        </div>
        <div class="form-group col-md-6">
          <input type="text" class="form-control" id="place" name="place" value="" placeholder="Adresa na kojoj ce se vrsiti fotografisanje">
        </div>

        <div class="form-group col-md-4">
          <select class="form-control-select" style="width:100%;" id="event" name="event">
            <option class="" value="">Predmet fotografisanja</option>
            <option class="" value="Svadba">Svadba</option>
            <option class="" value="Pozeraj">Pozeraj</option>
            <option class="" value="Rodjendan">Rodjendan</option>
            <option class="" value="Krstenje">Krstenje</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <input type="date" class="form-control" id="date" name="date" value="" placeholder="Adresa na kojoj ce se vrsiti fotografisanje">
        </div>
        <div class="form-group col-md-4">
          <!-- <input type="submit" class="form-control submit-shooting" value="Zakazite"> -->
          <button type="submit" class="form-control submit-shooting" name="submit-form" id="submit-form">Zakazite</button>
        </div>
      </div>
    </form>
  </div>
</section>
<!-- Features Section End -->
