<?php
$address = 'av hilda 123';
$city = 'salvador';
$state = 'bahia';
$country = 'brasil';

// Compor a string de endereço completa
$full_address = $address . ', ' . $city . ', ' . $state . ', ' . $country;

// Obter as coordenadas da localização utilizando a API do Google Maps
$maps_api_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($full_address);
$maps_api_response = file_get_contents($maps_api_url);
$maps_api_data = json_decode($maps_api_response);

// Extrair as coordenadas do objeto retornado pela API
$latitude = $maps_api_data->results[0]->geometry->location->lat;
$longitude = $maps_api_data->results[0]->geometry->location->lng;

// Gerar a string para o código QR com as coordenadas
$qr_code_fields = 'geo:' . $latitude . ',' . $longitude;

echo $qr_code_fields;



// TRANSFORMAR O CÓDIGO ACIMA EM UMA FUNÇÃO PARA 
// RETORNAR LATITUDE E LONGITUDE ATILIZANDO A API DO GOOGLE