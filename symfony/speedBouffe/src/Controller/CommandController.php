<?php

namespace App\Controller;

use App\Entity\Acheteur;
use \DateTime;
use App\Entity\Commande;
use App\Entity\DetailsCommande;
use App\Form\AnnonceFormType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CommandController extends Controller
{
    /**
     * @Route("/command", name="command")
     */
    public function index()
    {
        return $this->render('command/index.html.twig', [
            'controller_name' => 'CommandController',
        ]);
    }

/**
     * @Route("/newDetailCommande", name="detailCommande", methods="POST")
     */
    public function newDetailCommande(Request $request): Response
    {
	$foo = file_get_contents("php://input");
        $value = json_decode($foo);
	$em = $this->getDoctrine()->getManager();
        $Dcommande = new DetailsCommande();
        $Dcommande->setIdCommande($value->{'idCommande'});
	$Dcommande->setAge($value->{'Age'});
	$Dcommande->setTarif($value->{'Tarif'});
	$Dcommande->setRepas($value->{'Repas'});
	$Dcommande->setNom($value->{'Nom'});
	$Dcommande->setPrenom($value->{'Prenom'});
	$Dcommande->setCivilite($value->{'Civilite'});
	$em->persist($Dcommande);
        $em->flush();
	$id = $Dcommande->getId();
	$response = new Response();
	$response->setStatusCode(200, "Ok");
	// Set the content of the response
	$response->setContent($id);
	return $response;
    }


    /**
     * @Route("/newCommande", name="commande", methods="POST")
     */
    public function newCommande(Request $request): Response
    {
	$foo = file_get_contents("php://input");
        $value = json_decode($foo);
	$em = $this->getDoctrine()->getManager();
        $commande = new Commande();
        $commande->setIdAcheteur($value->{'idAcheteur'});
	$jour = \DateTime::createFromFormat('Y-m-d', $value->{'Jour'});
	$commande->setJour($jour);
	$horraire = \DateTime::createFromFormat('H:i', $value->{'Horaire_livraison'});
	$commande->setHoraireLivraison($horraire);
	$commande->setPaiementEspece($value->{'Paiement_espece'});
	$em->persist($commande);
        $em->flush();
	$id = $commande->getId();
	$response = new Response();
	$response->setStatusCode(200, "Ok");
	// Set the content of the response
	$response->setContent($id);
	return $response;
    }

    /**
     * @Route("/newAcheteur", name="acheteur", methods="POST")
     */
    public function newAcheteur(Request $request): Response
    {
	$foo = file_get_contents("php://input");
        $value = json_decode($foo);
	$em = $this->getDoctrine()->getManager();
        $acheteur = new Acheteur();
        $acheteur->setCivilite($value->{'Civilite'});
	$acheteur->setNom($value->{'Nom'});
	$acheteur->setPrenom($value->{'Prenom'});
	$acheteur->setEmail($value->{'Email'});
	$acheteur->setAge($value->{'Age'});
        $em->persist($acheteur);
        $em->flush();
	$id = $acheteur->getId();
	$response = new Response();
	$response->setStatusCode(200, "Ok");
	// Set the content of the response
	$response->setContent($id);
	return $response;
    }


}
