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

require '../../src/constants/database.secret.php';
require '../../src/utils/database.php';

$query = 'SELECT `Année`, SUM(`Consommation totale (MWh)`), SUM(`Consommation Agriculture (MWh)`), SUM(`Consommation Industrie (MWh)`), SUM(`Consommation Tertiaire (MWh)`), SUM(`Consommation Résidentiel (MWh)`), SUM(`Consommation Secteur Inconnu (MWh)`) FROM ' . $department . ' GROUP BY `Année` ORDER BY `Année` ASC;';

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