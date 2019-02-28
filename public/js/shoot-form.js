
var cities = [
  'Beograd-Barajevo',
  'Beograd-Voždovac',
  'Beograd-Vračar',
  'Beograd-Grocka',
  'Beograd-Zvezdara',
  'Beograd-Zemun',
  'Beograd-Lazarevac',
  'Beograd-Mladenovac',
  'Beograd-Novi Beograd',
  'Beograd-Obrenovac',
  'Beograd-Palilula',
  'Beograd-Rakovica',
  'Beograd-Savski Venac',
  'Beograd-Sopot',
  'Beograd-Stari Grad',
  'Beograd-Surčin',
  'Beograd-Čukarica',
  'Bačka Topola',
  'Mali Iđoš',
  'Subotica',
  'Žitište',
  'Zrenjanin',
  'Nova Crnja',
  'Novi Bečej',
  'Sečanj',
  'Ada',
  'Kanjiža',
  'Kikinda',
  'Novi Kneževac',
  'Senta',
  'Čoka',
  'Alibunar',
  'Bela Crkva',
  'Kovačica',
  'Kovin',
  'Opovo',
  'Pančevo',
  'Plandište',
  'Apatin',
  'Kula',
  'Odžaci',
  'Sombor',
  'Bač',
  'Bačka Palanka',
  'Beočin',
  'Bečej',
  'Vrbas',
  'Žabalj',
  'Novi Sad - grad',
  'Srbobran',
  'Sremski Karlovci',
  'Temerin',
  'Titel',
  'Inđija',
  'Irig',
  'Pećinci',
  'Ruma',
  'Sremska Mitrovica',
  'Stara Pazova',
  'Šid',
  'Bogatić',
  'Vladimirci',
  'Koceljeva',
  'Krupanj',
  'Loznica',
  'Ljubovija',
  'Mali Zvornik',
  'Šabac',
  'Valjevo',
  'Lajkovac',
  'Ljig',
  'Mionica',
  'Osečina',
  'Ub',
  'Velika Plana',
  'Smederevo',
  'Smederevska Palanka',
  'Veliko Gradište',
  'Golubac',
  'Žabari',
  'Žagubica',
  'Kučevo',
  'Malo Crniće',
  'Petrovac',
  'Požarevac',
  'Aranđelovac',
  'Batočina',
  'Knić',
  'Kragujevac - grad',
  'Lapovo',
  'Rača',
  'Topola',
  'Despotovac',
  'Jagodina',
  'Paraćin',
  'Rekovac',
  'Svilajnac',
  'Ćuprija',
  'Bor',
  'Kladovo',
  'Majdanpek',
  'Negotin',
  'Boljevac',
  'Zaječar',
  'Knjaževac',
  'Sokobanja',
  'Arilje',
  'Bajina Bašta',
  'Kosjerić',
  'Nova Varoš',
  'Požega',
  'Priboj',
  'Prijepolje',
  'Sjenica',
  'Užice',
  'Čajetina',
  'Gornji Milanovac',
  'Ivanjica',
  'Lučani',
  'Čačak',
  'Vrnjačka Banja',
  'Kraljevo',
  'Novi Pazar',
  'Raška',
  'Tutin',
  'Aleksandrovac',
  'Brus',
  'Varvarin',
  'Kruševac',
  'Trstenik',
  'Ćićevac',
  'Aleksinac',
  'Gadžin Han',
  'Doljevac',
  'Merošina',
  'Niš-Mediana',
  'Niš-Niška Banja',
  'Niš-Palilula',
  'Niš-Crveni Krst',
  'Ražanj',
  'Svrljig',
  'Blace',
  'Žitorađa',
  'Kuršumlija',
  'Prokuplje',
  'Babušnica',
  'Bela Palanka',
  'Dimitrovgrad',
  'Pirot',
  'Bojnik',
  'Vlasotince',
  'Lebane',
  'Leskovac',
  'Medveđa',
  'Crna Trava',
  'Bosilegrad',
  'Bujanovac',
  'Vladičin Han',
  'Vranje',
  'Preševo',
  'Surdulica',
  'Trgovište'
];

function get_results() {
  var keyword = $('#city').val();
  if(keyword.length < 1) {
    $("#suggestions").slideUp("slow");
    $('#city').val('');
  } else {
    $("#suggestions").html('');
    var regex = new RegExp(keyword, 'i');
    var results = [];
    for(var city of cities) {
      var res = city.match(regex);
      if(res) {
        let suggestion = '<li class="suggest-item" id="'+city+'" onclick="selectSuggestion(event)">'+city+'</li>';
        results.push(suggestion);
      }
    }
    //console.log(results);
    for(let city of results) {
      $("#suggestions").append(city);
    }
    show_suggestions();
  }

}

function show_suggestions() {
  $("#suggestions").slideDown("slow");
}

function selectSuggestion(event) {
  let id = event.target.id;
  $('#city').val(id);
  $("#suggestions").css('display', 'none');
}

$(document).on('click', function(e) {
  //e.preventDefault();
  var $menu = $('#suggestions');
  if (!$menu.is(e.target) // if the target of the click isn't the container...
    && $menu.has(e.target).length === 0) // ... nor a descendant of the container
    {
      $menu.hide();
    }
});

function AllowNumbersOnly(e) {
  var code = (e.which) ? e.which : e.keyCode;
  if (code > 31 && (code < 48 || code > 57)) {
    e.preventDefault();
  }
}

function checkEmail() {
  let email = $('#email').val();
  if(validateEmail(email) == false) {
    $("#email-form-error").slideDown("slow");
    slideUpMessage('email-form-error');
  }
}

$(document).on('submit', '#shooting_sch', function(e) {
  e.preventDefault();
  const email = $('#email').val();
  const name = $('#name').val();
  const phone = $('#phone').val();
  const city = $('#city').val();
  const place = $('#place').val();
  const shooting_event = $('#event').val();
  const date = $('#date').val();

  if(email == '' || name == '' || phone == '' || city == '' || place == '' || shooting_event == '' || date == '') {
    $("#form-errors").slideDown("slow");
    slideUpMessage('form-errors');
    return false;
  }
  if(validateEmail(email) == false) {
    $("#email-form-error").slideDown("slow");
    slideUpMessage('email-form-error');
    return false;
  }
  var data = new FormData();
  data.append('email', email);
  data.append('name', name);
  data.append('phone', phone);
  data.append('city', city);
  data.append('place', place);
  data.append('event', shooting_event);
  data.append('date', date);

  $.ajaxSetup({
     headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });
  $.ajax({
     url: "add-shooting",
     type: "POST",
     data: data,
     contentType: false,
     cache: false,
     processData: false,
     success: function(result) {
       if(result.success == 'SHOOT_ADD') {
         $("#form-success").slideDown("slow");
         //document.getElementById("shooting_sch").reset(); 
         $("#shooting_sch").trigger('reset');
         slideUpMessage('form-success');
       }
     }
   });
});

function slideUpMessage(id) {
  setTimeout(function(){
    $("#"+id).slideUp("slow");
  }, 3000);
}

function validateEmail(email) {
  var reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return reg.test(email);
}
