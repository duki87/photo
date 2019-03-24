@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Informacije o veb sajtu</h2>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <div class="col-md-8 mx-auto" style="color:white">
      Veb sajt za fotografije Zilijen Photo v.1<br>
      verzija za posetioce + verzija za administratore <br>
      tehnicki detalji: HTML/CSS/JavaScript/Jquery/AJAX/Bootstrap/FancyBox/Laravel framework 5.7 <br>
      Uputstvo za koriscenje sajta
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
        Uputstvo za koriscenje sajta
      </button>
      <br>
      Kontakt: dusanmarinkovic@hotmail.com <br>
    </div>
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
        Sajt radi na laravel platformi. Fotografije su organizovane u albume. Video klipovi se nalaze u posebnoj
        sekciji. Posetioci imaju mogucnost da zakazu fotografisanje, a podaci koje popune stizu administratorima.
        U okviru bloga moguce je dodati tekstove vezane za fotografiju, vesti iz oblasti fotografije itd.
        <br>
        <strong>Albumi</strong>
        <br>
        Za pocetak je potrebno napraviti albume tako sto administrator izabere opciju Dodaj album.
        Potrebno je uneti osnovne podatke koji se traze - naziv, opis (opciono) i naslovnu sliku albuma (opciono).
        Svi albumi se mogu videti u okviru stranice Svi albumi. Ovde je moguce za svaki album izmeniti osnovne
        podatke: naziv, naslovnu fotografiju, opis. Pored toga, moguce je izmeniti fotografije u albumu, svaku fotografiju
        posebno mozete obrisati ili dodati informacije o njoj.
        <br>
        <strong>Dodaj fotografije</strong>
        <br>
        Ovde dodajete fotografije tako sto najpre izaberete album, a zatim odaberete zeljene slike. Fotografije se
        automatski smanjuju na sirinu 1024 px, a visina se proporcionalno odredjuje. Takodje se dodaje zig na fotografiju.
        Nakon zavrsenog dodavanja na server, otvara se stranica na kojoj mozete dodati alternativne podatke za svaku
        fotografiju posebno.
        <br>
        <strong>Video</strong>
        <br>
        Video klipove mozete dodati na stranici Dodaj video. Dozvoljeni su formati mp4. U sekciji Svi video klipovi
        mozete videti sve klipove koji se nalaze na serveru.
        <br>
        <strong>Zahtevi</strong>
        <br>
        Ovde se nalaze zahtevi za fotografisanje koji stizu od posetilaca sajta. Tu su svi potrebni podaci o korisniku
        koji su poslali zahtev. Zastarele ili odbacene zahteve moguce je oznaciti kao neaktivne.
        <br>
        <strong>Ocisti foldere</strong>
        Ova opcija omogucava da se obrisu sa servera nepotrebne fotografije koje nisu povezane sa bazom podataka,
        a koje se mogu pojaviti u nekim situacijama. Potrebno je odabrati album i kliknuti na Ocisti folder, nakon
        provere i brisanja stize informacija o broju obrisanih fotografija.
        <br>
        <strong>Blog</strong>
        <br>
        Ova opcija sluzi da se dodaju novi tekstovi iz oblasti fotografije. Pored dodavanja novih tekstova, stare je
        moguce obrisati ili izmeniti. Blog omogucava unosenje teksta i odgovarajucih fotografija kao ilustracije.
        <br>
        <strong>Profil</strong>
        <br>
        Ova sekcija omogucava administratorima da provere svoje podatke, izmene e-mail, izmene lozinku.
        <br>
        <strong>Info</strong>
        <br>
        Ovde se nalaze osnovne informacije o sajtu i informacije o izmenama koje unosi web developer.
        <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
      </div>
    </div>
  </div>
</div>
@endsection
