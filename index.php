<?php
// header("Access-Control-Allow-Origin: *");
// header('Content-Type: text/plain');
// header("Access-Control-Allow-Headers: Content-Type, Accept");

if (is_numeric($_SERVER['QUERY_STRING'])) {
  $uri = getURI($_SERVER['QUERY_STRING']);
  $pid = str_replace("/id/","/collectie/", $uri);
  header("Location: $pid");
}

function getURI($id) {
  $query = "PREFIX owl: <http://www.w3.org/2002/07/owl#>
    PREFIX id: <https://hetutrechtsarchief.nl/id/>

    SELECT ?sub WHERE {
      ?sub owl:sameAs ?obj .
      values (?obj) { (id:r$id) }
    } LIMIT 1";

  $endpoint = "https://api.data.netwerkdigitaalerfgoed.nl/datasets/hetutrechtsarchief/Dataset/services/Dataset/sparql";

  $url = $endpoint . '?query=' . urlencode($query) . "&format=json";

  $response = file_get_contents($url);
  $json = json_decode($response);

  return $json[0]->sub;
}
?>