<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @Route("/users")
 */
class UserController extends FOSRestController
{
    /**
     * @Route("/me")
     */
    public function getMeAction()
    {
        return View::create(array("user" => $this->getUser()));
    }
}
