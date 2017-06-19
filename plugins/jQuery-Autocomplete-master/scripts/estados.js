
﻿var estados = {
    "AC": "AC - Acre",
    "AL": "Alagoas ",
    "AP": "Amapá ",
    "AM": "Amazonas ",
    "BA": "Bahia ",
    "CE": "Ceará ",
    "DF": "Distrito Federal",
    "ES": "Espírito Santo ",
    "GO": "Goiás",
    "MA": "Maranhão",
    "MT": "Mato Grosso ",
    "MS": "Mato Grosso do Sul",
    "MG": "Minas Gerais ",
    "PA": "Pará",
    "PB": "Paraíba",
    "PR": "Paraná",
    "PE": "Pernambuco",
    "PI": "Piauí",
    "RJ": "Rio de Janeiro",
    "RN": "Rio Grande do Norte",
    "RS": "Rio Grande do Sul",
    "RO": "Rondônia",
    "RR": "Roraima",
    "SC": "Santa Catarina",
    "SP": "São Paulo",
    "SE": "Sergipe",
    "TO": "Tocantins"
}

$("#autocomplete-ajaxEstados").focusout(function() {

    var estados = $("#autocomplete-ajax-xEstados").val().toString().substring(0, 2).toUpperCase();
  //  var cidades;
  
    $.mockjax({
        url: "/pages/php/buscaBairro.php?estado=" + estados,
        // You may need to include the [json2.js](https://raw.github.com/douglascrockford/JSON-js/master/json2.js) library for older browsers
        responseText: {"foo": "bar"}
    });


});

/*
 * 
 ﻿var cidades = {
 "AC": "Acre",
 "AL": "Alagoas ",
 "AP": "Amapá ",
 "AM": "Amazonas ",
 "BA": "Bahia ",
 "CE": "Ceará ",
 "DF": "Distrito Federal",
 "ES": "Espírito Santo ",
 "GO": "Goiás",
 "MA": "Maranhão",
 "MT": "Mato Grosso ",
 "MS": "Mato Grosso do Sul",
 "MG": "Minas Gerais ",
 "PA": "Pará",
 "PB": "Paraíba",
 "PR": "Paraná",
 "PE": "Pernambuco",
 "PI": "Piauí",
 "RJ": "Rio de Janeiro",
 "RN": "Rio Grande do Norte",
 "RS": "Rio Grande do Sul",
 "RO": "Rondônia",
 "RR": "Roraima",
 "SC": "Santa Catarina",
 "SP": "São Paulo",
 "SE": "Sergipe",
 "TO": "Tocantins"
 }
 */
