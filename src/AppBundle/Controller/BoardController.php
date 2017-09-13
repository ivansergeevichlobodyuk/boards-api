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
use AppBundle\Entity\Boards;

class BoardController extends FOSRestController
{

    /**
     * @Rest\Post("/api/boards")
     */
    public function putBoards(Request $request)
    {
        $data = new Boards();

        $content = json_decode($request->getContent(),true);
        $name = $content["board"]["name"];
        $count = $content["board"]["count"];
        if(empty($name))
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setName($name);
        $data->setCount($count);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        $data = array( 'board' => array( 'id' => $data->getId(), 'name' => $data->getName(), 'count' => $data->getCount() ) );
        return $data;
    }


    /**
     * @Rest\Get("/api/boards/")
     */
    public function getBoards()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Boards')->findAllBoards();
        if ($restresult === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
       // echo "<pre>"; print_r($restresult); die;
        return $restresult;
    }

    /**
     * @Rest\Get("/api/boards/{id}/")
     */
    public function getBoardById($id)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Boards')->findBoardById($id);
        if ($restresult === null) {
            return new View("there are no board exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }



}