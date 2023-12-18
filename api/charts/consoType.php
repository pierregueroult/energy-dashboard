<?php

if (!isset($_GET['department'])) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid request'
    ));
    exit;
}

if (!isset($_GET['year'])) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid request'
    ));
    exit;
}

$department = $_GET['department'];
$year = $_GET['year'];

require '../../src/constants/deps.php';
require '../../src/utils/getAllKeysFromArray.php';
require '../../src/constants/years.php';

if (!in_array($department, getAllKeysFromArray(DEPARTMENTS))) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid department'
    ));
    exit;
}

if (!in_array($year, YEARS)) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Year out of range'
    ));
    exit;
}

require '../../src/constants/database.secret.php';
require '../../src/utils/database.php';

$query = 'SELECT SUM(`Consommation Agriculture (MWh)`) as "C. Agricole", SUM(`Nombre de points Agriculture`) as "P. Agricole", SUM(`Consommation Industrie (MWh)`) as "C. Industrie", SUM(`Nombre de points Industrie`) as "P. Industrie", SUM(`Consommation Tertiaire (MWh)`) as "C. Tertiaire", SUM(`Nombre de points Tertiaire`) as "P. Tertiaire", SUM(`Consommation Résidentiel (MWh)`) as "C. Résidentiel", SUM(`Nombre de points Résidentiel`) as "P. Résidentiel", SUM(`Consommation Secteur Inconnu (MWh)`) as "C. Inconnue", SUM(`Nombre de points Secteur Inconnu`) as "P. Inconnu" FROM `' . PREFIX . $department . '` WHERE `Année` = ' . $year . ' GROUP BY `Année`;';

$result = $pdo->query($query);

if (!$result) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Database query failed'
    ));
    exit;
}

$data = $result->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(array(
    'status' => true,
    'data' => $data
));

exit;

?>