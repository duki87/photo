@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Informacije o veb sajtu</h2>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <div class="col-md-8 mx-auto">
      Veb sajt za fotografije Zilijen Photo v.1<br>
      verzija za posetioce + verzija za administratore <br>
      tehnicki detalji: HTML/CSS/JavaScript/Jquery/AJAX/Bootstrap/FancyBox/Laravel framework 5.7 <br>
      Uputstvo za koriscenje sajta
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Uputstvo za koriscenje sajta
      </button>
      <br>
      Kontakt: dusanmarinkovic@hotmail.com <br>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Uputstvo za rad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Sajt radi na laravel platformi. Fotografije su organizovane u albume. Pored albuma sa fotografijama,
        posetioci imaju mogucnost da zakazu fotografisanje, a podaci koje popune stizu administratorima.
        <br>
        <strong>Albumi</strong>
        <br>
        Za pocetak je potrebno napraviti albume tako sto administrator izabere opciju Dodaj album.
        Potrebno je uneti osnovne podatke koji se traze - naziv, opis (opciono) i naslovnu sliku albuma (opciono).
        Svi albumi se mogu videti u okviru stranice Svi albumi. Ovde je moguce za svaki album izmeniti osnovne
        podatke,
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
      </div>
    </div>
  </div>
</div>
@endsection
