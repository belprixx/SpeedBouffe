<?php

use SpeedBouffe\Database;

require_once 'lib/autoload.php';

function setContext($json)
{
	$opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/json',
            'content' => json_encode($json)
        )
    );
    # Create the context
    $context = stream_context_create($opts);
	return $context;
}

$faker = Faker\Factory::create();
$db = new Database();

if (empty($argv[1]) == true) {
    $timer = 1000000;
} else {
    $timer = $argv[1]*1000;
}

while (true) {
    $result = array();
	$contextDetail = array();
    usleep($timer);

    $firstAge = $db->getAge();
    $firstCivility = $db->getGender($firstAge, false);
    $firstNom = $faker->firstName;
    $firstPrenom = $faker->firstName;
    $firstEmail = $firstNom . '.' . $firstPrenom . '@' . $db->getSuffixEmail();
    $firstPersonPricing = $db->getPricing($firstAge);
    $firstPersonMeal = $db->getMeal();

    $nbMeal = $db->getNbMeal();

    $result['Acheteur']['Civilite'] = $firstCivility;
    $result['Acheteur']['Nom'] = $firstNom;
    $result['Acheteur']['Prenom'] = $firstPrenom;
    $result['Acheteur']['Age'] = $firstAge;
    $result['Acheteur']['Email'] = strtolower($firstEmail);

    $result['Infos_commande']['Jour'] = $db->getBuyDate();
    $result['Infos_commande']['Horaire_livraison'] = $db->getHour();
    $result['Infos_commande']['Paiement_espece'] = $db->needCash();

    for ($i = 0; $i < $nbMeal; $i++) {
        $cmd = "Commande" . $i;
        if ($i == 0) {
            $result['Details_commande'][$i][$cmd]['Repas'] = $firstPersonMeal;
            $result['Details_commande'][$i][$cmd]['Civilite'] = $firstCivility;
            $result['Details_commande'][$i][$cmd]['Nom'] = $firstNom;
            $result['Details_commande'][$i][$cmd]['Prenom'] = $firstPrenom;
            $result['Details_commande'][$i][$cmd]['Age'] = $firstAge;
            $result['Details_commande'][$i][$cmd]['Tarif'] = $firstPersonPricing;
        } else {
            $otherAge = $db->getAge();
            $otherCivility = $db->getGender($otherAge, false);
            $otherNom = $faker->firstName;
            $otherPrenom = $faker->firstName;
            $otherPersonPricing = $db->getPricing($otherAge);
            $otherPersonMeal = $db->getMeal();

            $result['Details_commande'][$i][$cmd]['Repas'] = $otherPersonMeal;
            $result['Details_commande'][$i][$cmd]['Civilite'] = $otherCivility;
            $result['Details_commande'][$i][$cmd]['Nom'] = $otherNom;
            $result['Details_commande'][$i][$cmd]['Prenom'] = $otherPrenom;
            $result['Details_commande'][$i][$cmd]['Age'] = $otherAge;
            $result['Details_commande'][$i][$cmd]['Tarif'] = $otherPersonPricing;
        }
    }
    echo(json_encode($result['Acheteur']));
    $contextAcheteur = setContext($result['Acheteur']);
    $idAcheteur = intval(file_get_contents('http://localhost:8000/newAcheteur', false, $contextAcheteur));
    echo $idAcheteur;
    $result['Infos_commande']['idAcheteur'] = $idAcheteur;
    $contextCommande = setContext($result['Infos_commande']);
    echo(json_encode($result['Infos_commande']));
    $idCommande = intval(file_get_contents('http://localhost:8000/newCommande', false, $contextCommande));
    for ($i = 0; $i < sizeof($result['Details_commande']); $i++) {
    	$cmd = "Commande" . $i;
	$result['Details_commande'][$i][$cmd]['idCommande'] = $idCommande;
	echo(json_encode($result['Details_commande'][$i][$cmd]));
	$contextDetail[$i] = setContext($result['Details_commande'][$i][$cmd]);
	file_get_contents('http://localhost:8000/newDetailCommande', false, $contextDetail[$i]);
    }
    echo PHP_EOL;
}


