<?php

if (!isset($_GET['department'])) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid request'
    ));
    exit;
}

$department = $_GET['department'];

require '../../src/constants/deps.php';
require '../../src/utils/getAllKeysFromArray.php';

if (!in_array($department, getAllKeysFromArray(DEPARTMENTS))) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid department'
    ));
    exit;
}

$region = DEPARTMENTS[$department]['region'];

require '../../src/constants/database.secret.php';
require '../../src/utils/database.php';

$query = "SELECT MONTH(`Date`) as 'Mois', SUM(`Consommation (MW)`) as 'Consommation',
(SUM(`Thermique (MW)`) + SUM(`Nucléaire (MW)`) + SUM(`Eolien (MW)`) + SUM(`Solaire (MW)`) + SUM(`Hydraulique (MW)`) + SUM(`Bioénergies (MW)`) + SUM(`Ech. physiques (MW)`)) as 'Production' FROM `" . $region . "` WHERE `Date` LIKE '2021%' GROUP BY MONTH(`Date`);";

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

?>