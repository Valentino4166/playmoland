<?php

namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\Common\Persistence\ObjectManager;

/**
* @Route("/api")
*/
class UserApiController extends FOSRestController
{
   /**
    * @Rest\Get("/users/{username}")
    */
   public function getUserbyIdentifiant($username, ObjectManager $manager)
   {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneBy(["username" => $username]);

        if ($user == null)
        {
            throw new HttpException(404, "User not found");
        }

        $userInfo = [
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "username" => $user->getUsername(),
            "adresse" => $user->getAdresse(),
            "code postal" => $user->getCp(),
            "ville" => $user->getVille(),
        ];

        return $this->handleView($this->view($userInfo, 200));
   }

   
}
