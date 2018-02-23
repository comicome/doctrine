<?php
/**
 * Created by PhpStorm.
 * User: rototo
 * Date: 14/02/2018
 * Time: 19:56
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// create_product.php <name>
require_once "../bootstrap.php";

// init du repo
$repository = $entityManager->getRepository('Tvtruc\Entities\Serie');
$repositoryT = $entityManager->getRepository('Tvtruc\Entities\Translation');
$searchGet = isset($_GET['name'])? $_GET['name'] : die();



$dqlSeriesNameSearchPattern = $searchGet;
$query = $repository->createQueryBuilder('s')
	->where('s.serieName LIKE :name') // les contraintes
	->setParameter('name', '%'. $dqlSeriesNameSearchPattern .'%')
    ->setMaxResults(4)
	->getQuery();
$dqlSeries = $query->getResult();


$result = [];
foreach ($dqlSeries as $serie) {
    $liste = array("seriesname" => $serie->getname(), "translation"=>$serie->getTranslation(), "banner" =>$serie->getBanner(), "episodes" => array());
    foreach ($serie->episodes as $episode) {
        $liste['episodes'][] = $episode->getName();
    }
    $result[] = $liste;
}


echo "-----------------------\r\n";
echo "findAll result EXPORT + JSON_ENCODE \r\n";
echo "-----------------------\r\n";
echo $json = json_encode($result, JSON_PRETTY_PRINT);
echo $json;
