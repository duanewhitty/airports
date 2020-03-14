<?php

// Use the air-port-codes.com api
require_once('air-port-codes-api.php');

// List of IATA airport codes used by automattic.com for the heatmap
// These are the search terms to pass to the API
$airports = [
    'dfw', 'dca', 'lax', 
    'ord', 'sjc', 'mxp',
    'nrt', 'arn', 'atl',
    'jnb', 'sea', 'bur',
    'ewr', 'sat', 'hkg',
    'syd', 'lhr', 'fra',
    'den', 'mad', 'kix',
    'cdg', 'vie', 'mia',
    'gru', 'bom', 'tpe',
    'yyz', 'sin', 'ams',
];

// Setup request parameters to return one listing per result
$apc = new apc('single', $params);

$i = 1;  // Print line numbers so it looks prettier and is easier to read
foreach ($airports as $airport) // Unfortunately the API can't take a list of search terms
    {
    $apcResponseObj = $apc->request($airport);
    if ($apcResponseObj->status)
        {
        // Convert the stdClass object returned to an array to make it easy to get the values
        $result = (get_object_vars($apcResponseObj->airport));
        print($i . "." . "\t" . $result['iata'] . ' -> ' . $result['full_location'] . "\n");
        }
    else
        print_r($apcResponseObj->message); // Print any errors
    $i++;
    };
?>
