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

$query = 'SELECT MONTH(`Date`) as "Mois", SUM(`Thermique (MW)`) as "Thermique", SUM(`Nucléaire (MW)`) as "Nucléaire", SUM(`Eolien (MW)`) as "Eolien", SUM(`Solaire (MW)`) as "Solaire", SUM(`Hydraulique (MW)`) as "Hydraulique", SUM(`Bioénergies (MW)`) as "Bioénergies", SUM(`Ech. physiques (MW)`) as "Ech. physiques" FROM `' . PREFIX . $region . '` GROUP BY MONTH(`Date`) ORDER BY MONTH(`Date`);';

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