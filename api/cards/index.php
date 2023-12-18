<?php

if (!isset($_GET['index'], $_GET['department'])) {
    echo json_encode(array(
        'status' => false,
        'message' => 'Invalid request'
    ));
    exit;
} else {
    $index = $_GET['index'];
    $department = $_GET['department'];
    if (!is_numeric($index) || !is_string($department)) {
        echo json_encode(array(
            'status' => false,
            'message' => 'Wrong type'
        ));
        exit;
    }
    if ($index < 1 || $index > 4) {
        echo json_encode(array(
            'status' => false,
            'message' => 'Index out of range'
        ));
        exit;
    }
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

    if ($index == 1) {
        $query = 'SELECT SUM(`Consommation totale (MWh)`) as consoThisYear FROM ' . PREFIX . $department . ' WHERE `Année` = 2021;';
        $result = $pdo->query($query);

        $consoThisYear = $result->fetch(PDO::FETCH_ASSOC);

        $query = 'SELECT SUM(`Consommation totale (MWh)`) as consoLastYear FROM ' . PREFIX . $department . ' WHERE `Année` = 2020;';
        $result = $pdo->query($query);

        $consoLastYear = $result->fetch(PDO::FETCH_ASSOC);

        echo json_encode(array(
            'status' => true,
            'data' => [
                'legend' => 'Consommation totale en 2021 (' . ucfirst($department) . ')',
                'unit' => 'MWh',
                'info' => $consoThisYear['consoThisYear'],
                'ratio' => ($consoThisYear['consoThisYear'] - $consoLastYear['consoLastYear']) / $consoLastYear['consoLastYear'] * 100
            ]
        ));
        exit;
    }

    if ($index == 4) {
        $query = 'SELECT SUM(`Eolien (MW)` + `Solaire (MW)` + `Hydraulique (MW)` + `Bioénergies (MW)`) / SUM(`Thermique (MW)` + `Nucléaire (MW)` + `Eolien (MW)` + `Solaire (MW)` + `Hydraulique (MW)` + `Bioénergies (MW)`) * 100 AS PERCENT FROM ' . PREFIX . DEPARTMENTS[$department]['region'] . " WHERE `Date`LIKE '2021%';";
        $result = $pdo->query($query);

        $dataLastYear = $result->fetch(PDO::FETCH_ASSOC);

        $query = 'SELECT SUM(`Eolien (MW)` + `Solaire (MW)` + `Hydraulique (MW)` + `Bioénergies (MW)`) / SUM(`Thermique (MW)` + `Nucléaire (MW)` + `Eolien (MW)` + `Solaire (MW)` + `Hydraulique (MW)` + `Bioénergies (MW)`) * 100 AS PERCENT FROM ' . PREFIX . DEPARTMENTS[$department]['region'] . " WHERE `Date`LIKE '2022%';";

        $result = $pdo->query($query);

        $dataThisYear = $result->fetch(PDO::FETCH_ASSOC);

        echo json_encode(array(
            'status' => true,
            'data' => [
                'legend' => 'Énergies renouvelables (' . ucfirst(DEPARTMENTS[$department]['region']) . ')',
                'unit' => '%',
                'info' => $dataThisYear['PERCENT'],
                'ratio' => ($dataThisYear['PERCENT'] - $dataLastYear['PERCENT']) / $dataLastYear['PERCENT'] * 100
            ]
        ));
        exit;
    }

    if ($index == 2) {
        $query = 'SELECT `Année`, SUM(`Nombre de points Agriculture`) + SUM(`Nombre de points Industrie`) + SUM(`Nombre de points Tertiaire`) + SUM(`Nombre de points Résidentiel`) + SUM(`Nombre de points Secteur Inconnu`) as "Points" FROM `' . PREFIX . $department . '` WHERE `Année` = 2021 GROUP BY `Année`;';

        $result = $pdo->query($query);

        $dataThisYear = $result->fetch(PDO::FETCH_ASSOC);

        $query = 'SELECT `Année`, SUM(`Nombre de points Agriculture`) + SUM(`Nombre de points Industrie`) + SUM(`Nombre de points Tertiaire`) + SUM(`Nombre de points Résidentiel`) + SUM(`Nombre de points Secteur Inconnu`) as "Points" FROM `' . PREFIX . $department . '` WHERE `Année` = 2020 GROUP BY `Année`;';

        $result = $pdo->query($query);

        $dataLastYear = $result->fetch(PDO::FETCH_ASSOC);

        echo json_encode(array(
            'status' => true,
            'data' => [
                'legend' => 'Points de livraison en 2021 (' . ucfirst($department) . ')',
                'unit' => 'points',
                'info' => $dataThisYear['Points'],
                'ratio' => ($dataThisYear['Points'] - $dataLastYear['Points']) / $dataLastYear['Points'] * 100
            ]
        ));
        exit;
    }

    if ($index == 3) {
        $query = 'SELECT `Année`, SUM(`Nombre de mailles secretisées (agriculture)`) + SUM(`Nombre de mailles secretisées (industrie)`) + SUM(`Nombre de mailles secretisées (tertiaire)`) + SUM(`Nombre de mailles secretisées (résidentiel)`) + SUM(`Nombre de mailles secretisées (secteur inconnu)`) as "Mailles" FROM `' . PREFIX . $department . '` WHERE `Année` = 2021 GROUP BY `Année`;';
        $result = $pdo->query($query);
        $dataThisYear = $result->fetch(PDO::FETCH_ASSOC);

        $query = 'SELECT `Année`, SUM(`Nombre de mailles secretisées (agriculture)`) + SUM(`Nombre de mailles secretisées (industrie)`) + SUM(`Nombre de mailles secretisées (tertiaire)`) + SUM(`Nombre de mailles secretisées (résidentiel)`) + SUM(`Nombre de mailles secretisées (secteur inconnu)`) as "Mailles" FROM `' . PREFIX . $department . '` WHERE `Année` = 2020 GROUP BY `Année`;';

        $result = $pdo->query($query);

        $dataLastYear = $result->fetch(PDO::FETCH_ASSOC);

        echo json_encode(array(
            'status' => true,
            'data' => [
                'legend' => 'Mailles secrétisées en 2021 (' . ucfirst($department) . ')',
                'unit' => 'mailles',
                'info' => $dataThisYear['Mailles'],
                'ratio' => ($dataThisYear['Mailles'] - $dataLastYear['Mailles']) / $dataLastYear['Mailles'] * 100
            ]
        ));
        exit;
    }
}

?>