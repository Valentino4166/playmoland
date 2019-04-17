<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use Proxies__CG__\App\Entity\Category;
use App\Entity\Commande;
use App\Entity\Contenucommande;

/**
* @Route("/api")
*/
class ArticleApiController extends FOSRestController
{
    /**
    * @Rest\Get("/articles")
    */
    public function getArticles(ObjectManager $manager)
    {
        //récupére les produts
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findall();


        //représenté les données
        $allarticles = [];
        foreach ($articles as $article) {
             //récupére la category
            $repository = $this->getDoctrine()->getRepository(Category::class);
            $categorie = $repository->find($article->getCategory());

            //représenté les données
            $allarticles[] = [
                "id" => $article->getId(),
                "title" => $article->getTitle(),
                "content" => $article->getContent(),
                "prix" => $article->getPrix(),
                "image" => $article->getImage(),
               "category" => $categorie->getTitle()

            ];
        }
        return $this->handleView($this->view($allarticles, 200));

    }
    
    /**
    * @Rest\Get("/articles/{id}")
    */
    public function getArticlesById($id, ObjectManager $manager)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $article = $repository->findOneBy(["id" => $id]);

        if ($article == null)
        {
            throw new HttpException(404, "User not found");
        }
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categorie = $repository->find($article->getCategory());

        $articleInfo = [
            "id" => $article->getId(),
            "title" => $article->getTitle(),
            "content" => $article->getContent(),
            "prix" => $article->getPrix(),
            "image" => $article->getImage(),
            "category" => $categorie->getTitle()
        ];

        return $this->handleView($this->view($articleInfo, 200));

    }

    /**
     * @Rest\Get("/articles/barcode/{barcode}")
     */
    public function getArticlesByBarcode($barcode = null)
    {
        if ($barcode == null) {
            throw new HttpException(400, "Barcode not valid");
        }
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $article = $repository->findOneBy(["barcode" => $barcode]);
        if ($article == null) {
            throw new HttpException(404, "article not found");
        }
        $articleInfo = [
                "id" => $article->getId(),
                "title" => $article->getTitle(),
                "content" => $article->getContent(),
                "prix" => $article->getPrix(),
                "image" => $article->getImage(),
               "category" => $article->getTitle()

        ];

        return $this->handleView($this->view($articleInfo, 200));
    }

    /**
     * @Rest\Patch("/articles/{id}/quantity")
     */
    public function updateArticlesById(Article $article = null, Request $request, ObjectManager $manager)
    {
        if ($article == null) {
            throw new HttpException(404, "article not found");
        }
        $qte = $request->request->get("quantity");
        if ($qte == null || !is_numeric($qte)) {
            throw new HttpException(400, "Bad request");
        }
        $article->setQuantity($qte);
        $manager->persist($article);
        $manager->flush();
        return $this->handleView($this->view(["message" => "quantity updated"], 200));
    }
    
}


