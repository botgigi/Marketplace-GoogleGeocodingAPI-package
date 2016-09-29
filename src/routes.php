<?php
$routes = [
    'addressToCoordinates',
    'getAddressComponents',
    'coordinatesToAddress',
    'metadata'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

