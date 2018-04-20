<?php

use SpeedBouffe\Database;

require_once 'lib/autoload.php';

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

	$contextAcheteur = setContext($result['Acheteur']);
    $result['Infos_commande']['Jour'] = $db->getBuyDate();
    $result['Infos_commande']['Horaire_livraison'] = $db->getHour();
    $result['Infos_commande']['Paiement_espece'] = $db->needCash();
	$contextInfoCommande = setContext($result['Infos_commande']);

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
			
		$contextDetail[$i] = setContext($result['Details_commande'][$i]);
        }
    }
    file_get_contents('http://localhost:8100/acheteur', false, $contextAcheteur);
    echo(json_encode($result));
	
	file_get_contents('http://localhost:8100/infoCommande', false, $contextCommand);
    echo(json_encode($result));
	for ($i = 0; $i < $nbMeal; $i++) {
		file_get_contents('http://localhost:8100/infoCommande', false, $contextDetail[$i]);
	}
    echo PHP_EOL;
}
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

