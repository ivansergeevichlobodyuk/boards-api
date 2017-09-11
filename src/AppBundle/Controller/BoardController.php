<?php
/**
 * Created by PhpStorm.
 * User: ivanlobodyuk
 * Date: 11.09.17
 * Time: 17:45
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\User;

class BoardController extends FOSRestController
{
    /**
     * @Rest\Get("/boards")
     */
    public function getBoards()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Boards')->findAll();
        if ($restresult === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/boards/{id}")
     */
    public function getBoardById($id)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Boards')->find($id);
        if ($restresult === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

}