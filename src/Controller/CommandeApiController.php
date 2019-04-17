<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;

/**
* @Route("/api")
*/
class CommandeApiController extends FOSRestController
{
    /**
    * @Rest\Get("/users/{id}/commandes")
    */
    public function getcommande($id)
    {
        $repository = $this->getDoctrine()->getRepository(Commande::class);
        $userCommandes = $repository->findBy(["client_id" => $id]);

        $allcommandes = [];
        foreach ($userCommandes as $commande) {

            //représenté les données
            $allcommandes[] = [
                "id" => $commande->getId(),
                "PrixTotal" => $commande->getPrixTotal()

            ];
        }
        return $this->handleView($this->view($allcommandes, 200));

    }
    
    /**
     * @Rest\Get("/commandes/{id}")
     */
    public function getCommandeById(Commande $commandes = null)
    {
        if ($commandes == null) {
            throw new HttpException(404, "Order not found");
        }
        $commandeInfo = [
            "id" => $commandes->getId(),
            "total" => $commandes->getPrixtotal(),
            "Articledelacommande" => [],
        ];
        foreach ($commandes->getContenucommandes() as $ContenuCommande) {
            $commandeInfo["Articledelacommande"][] = [
                "id" => $ContenuCommande->getId(),
                "title" => $ContenuCommande->getArticle()->getTitle(),
                "prix" => $ContenuCommande->getArticle()->getPrix()
            ];
        }
        return $this->handleView($this->view($commandeInfo, 200));
    }
}

