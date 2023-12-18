<?php 

// ! Ce tableau est utile uniquement lorsqu'on active le mode boosté dans le menu de configuration

// contain all departement in france in lowercase and without accent and without island and without overseas department

const DEPARTMENTS = array(
    "ain" => array(
        "number" => "01",
        "region" => "auvergne-rhone-alpes",
    ),
    "aisne" => array(
        "number" => "02",
        "region" => "hauts-de-france",
    ),
    "allier" => array(
        "number" => "03",
        "region" => "auvergne-rhone-alpes",
    ),
    "alpes-de-haute-provence" => array(
        "number" => "04",
        "region" => "provence-alpes-cote-d-azur",
    ),
    "hautes-alpes" => array(
        "number" => "05",
        "region" => "provence-alpes-cote-d-azur",
    ),
    "alpes-maritimes" => array(
        "number" => "06",
        "region" => "provence-alpes-cote-d-azur",
    ),
    "ardeche" => array(
        "number" => "07",
        "region" => "auvergne-rhone-alpes",
    ),
    "ardennes" => array(
        "number" => "08",
        "region" => "grand-est",
    ),
    "ariege" => array(
        "number" => "09",
        "region" => "occitanie",
    ),
    "aube" => array(
        "number" => "10",
        "region" => "grand-est",
    ),
    "aude" => array(
        "number" => "11",
        "region" => "occitanie",
    ),
    "aveyron" => array(
        "number" => "12",
        "region" => "occitanie",
    ),
    "bouches-du-rhone" => array(
        "number" => "13",
        "region" => "provence-alpes-cote-d-azur",
    ),
    "calvados" => array(
        "number" => "14",
        "region" => "normandie",
    ),
    "cantal" => array(
        "number" => "15",
        "region" => "auvergne-rhone-alpes",
    ),
    "charente" => array(
        "number" => "16",
        "region" => "nouvelle-aquitaine",
    ),
    "charente-maritime" => array(
        "number" => "17",
        "region" => "nouvelle-aquitaine",
    ),
    "cher" => array(
        "number" => "18",
        "region" => "centre-val-de-loire",
    ),
    "correze" => array(
        "number" => "19",
        "region" => "nouvelle-aquitaine",
    ),
    "corse-du-sud" => array(
        "number" => "2a",
        "region" => "corse",
    ),
    "haute-corse" => array(
        "number" => "2b",
        "region" => "corse",
    ),
    "cote-d-or" => array(
        "number" => "21",
        "region" => "bourgogne-franche-comte",
    ),
    "cotes-d-armor" => array(
        "number" => "22",
        "region" => "bretagne",
    ),
    "creuse" => array(
        "number" => "23",
        "region" => "nouvelle-aquitaine",
    ),
    "dordogne" => array(
        "number" => "24",
        "region" => "nouvelle-aquitaine",
    ),
    "doubs" => array(
        "number" => "25",
        "region" => "bourgogne-franche-comte",
    ),
    "drome" => array(
        "number" => "26",
        "region" => "auvergne-rhone-alpes",
    ),
    "eure" => array(
        "number" => "27",
        "region" => "normandie",
    ),
    "eure-et-loir" => array(
        "number" => "28",
        "region" => "centre-val-de-loire",
    ),
    "finistere" => array(
        "number" => "29",
        "region" => "bretagne",
    ),
    "gard" => array(
        "number" => "30",
        "region" => "occitanie",
    ),
    "haute-garonne" => array(
        "number" => "31",
        "region" => "occitanie",
    ),
    "gers" => array(
        "number" => "32",
        "region" => "occitanie",
    ),
    "gironde" => array(
        "number" => "33",
        "region" => "nouvelle-aquitaine",
    ),
    "herault" => array(
        "number" => "34",
        "region" => "occitanie",
    ),
    "ille-et-vilaine" => array(
        "number" => "35",
        "region" => "bretagne",
    ),
    "indre" => array(
        "number" => "36",
        "region" => "centre-val-de-loire",
    ),
    "indre-et-loire" => array(
        "number" => "37",
        "region" => "centre-val-de-loire",
    ),
    "isere" => array(
        "number" => "38",
        "region" => "auvergne-rhone-alpes",
    ),
    "jura" => array(
        "number" => "39",
        "region" => "bourgogne-franche-comte",
    ),
    "landes" => array(
        "number" => "40",
        "region" => "nouvelle-aquitaine",
    ),
    "loir-et-cher" => array(
        "number" => "41",
        "region" => "centre-val-de-loire",
    ),
    "loire" => array(
        "number" => "42",
        "region" => "auvergne-rhone-alpes",
    ),
    "haute-loire" => array(
        "number" => "43",
        "region" => "auvergne-rhone-alpes",
    ),
    "loire-atlantique" => array(
        "number" => "44",
        "region" => "pays-de-la-loire",
    ),
    "loiret" => array(
        "number" => "45",
        "region" => "centre-val-de-loire",
    ),
    "lot" => array(
        "number" => "46",
        "region" => "occitanie",
    ),
    "lot-et-garonne" => array(
        "number" => "47",
        "region" => "nouvelle-aquitaine",
    ),
    "lozere" => array(
        "number" => "48",
        "region" => "occitanie",
    ),
    "maine-et-loire" => array(
        "number" => "49",
        "region" => "pays-de-la-loire",
    ),
    "manche" => array(
        "number" => "50",
        "region" => "normandie",
    ),
    "marne" => array(
        "number" => "51",
        "region" => "grand-est",
    ),
    "haute-marne" => array(
        "number" => "52",
        "region" => "grand-est",
    ),
    "mayenne" => array(
        "number" => "53",
        "region" => "pays-de-la-loire",
    ),
    "meurthe-et-moselle" => array(
        "number" => "54",
        "region" => "grand-est",
    ),
    "meuse" => array(
        "number" => "55",
        "region" => "grand-est",
    ),
    "morbihan" => array(
        "number" => "56",
        "region" => "bretagne",
    ),
    "moselle" => array(
        "number" => "57",
        "region" => "grand-est",
    ),
    "nievre" => array(
        "number" => "58",
        "region" => "bourgogne-franche-comte",
    ),
    "nord" => array(
        "number" => "59",
        "region" => "hauts-de-france",
    ),
    "oise" => array(
        "number" => "60",
        "region" => "hauts-de-france",
    ),
    "orne" => array(
        "number" => "61",
        "region" => "normandie",
    ),
    "pas-de-calais" => array(
        "number" => "62",
        "region" => "hauts-de-france",
    ),
    "puy-de-dome" => array(
        "number" => "63",
        "region" => "auvergne-rhone-alpes",
    ),
    "pyrenees-atlantiques" => array(
        "number" => "64",
        "region" => "nouvelle-aquitaine",
    ),
    "hautes-pyrenees" => array(
        "number" => "65",
        "region" => "occitanie",
    ),
    "pyrenees-orientales" => array(
        "number" => "66",
        "region" => "occitanie",
    ),
    "bas-rhin" => array(
        "number" => "67",
        "region" => "grand-est",
    ),
    "haut-rhin" => array(
        "number" => "68",
        "region" => "grand-est",
    ),
    "rhone" => array(
        "number" => "69",
        "region" => "auvergne-rhone-alpes",
    ),
    "haute-saone" => array(
        "number" => "70",
        "region" => "bourgogne-franche-comte",
    ),
    "saone-et-loire" => array(
        "number" => "71",
        "region" => "bourgogne-franche-comte",
    ),
    "sarthe" => array(
        "number" => "72",
        "region" => "pays-de-la-loire",
    ),
    "savoie" => array(
        "number" => "73",
        "region" => "auvergne-rhone-alpes",
    ),
    "haute-savoie" => array(
        "number" => "74",
        "region" => "auvergne-rhone-alpes",
    ),
    "paris" => array(
        "number" => "75",
        "region" => "ile-de-france",
    ),
    "seine-maritime" => array(
        "number" => "76",
        "region" => "normandie",
    ),
    "seine-et-marne" => array(
        "number" => "77",
        "region" => "ile-de-france",
    ),
    "yvelines" => array(
        "number" => "78",
        "region" => "ile-de-france",
    ),
    "deux-sevres" => array(
        "number" => "79",
        "region" => "nouvelle-aquitaine",
    ),
    "somme" => array(
        "number" => "80",
        "region" => "hauts-de-france",
    ),
    "tarn" => array(
        "number" => "81",
        "region" => "occitanie",
    ),
    "tarn-et-garonne" => array(
        "number" => "82",
        "region" => "occitanie",
    ),
    "var" => array(
        "number" => "83",
        "region" => "provence-alpes-cote-d-azur",
    ),
    "vaucluse" => array(
        "number" => "84",
        "region" => "provence-alpes-cote-d-azur",
    ),
    "vendee" => array(
        "number" => "85",
        "region" => "pays-de-la-loire",
    ),
    "vienne" => array(
        "number" => "86",
        "region" => "nouvelle-aquitaine",
    ),
    "haute-vienne" => array(
        "number" => "87",
        "region" => "nouvelle-aquitaine",
    ),
    "vosges" => array(
        "number" => "88",
        "region" => "grand-est",
    ),
    "yonne" => array(
        "number" => "89",
        "region" => "bourgogne-franche-comte",
    ),
    "territoire-de-belfort" => array(
        "number" => "90",
        "region" => "bourgogne-franche-comte",
    ),
    "essonne" => array(
        "number" => "91",
        "region" => "ile-de-france",
    ),
    "hauts-de-seine" => array(
        "number" => "92",
        "region" => "ile-de-france",
    ),
    "seine-saint-denis" => array(
        "number" => "93",
        "region" => "ile-de-france",
    ),
    "val-de-marne" => array(
        "number" => "94",
        "region" => "ile-de-france",
    ),
    "val-d-oise" => array(
        "number" => "95",
        "region" => "ile-de-france",
    ),


);


?>