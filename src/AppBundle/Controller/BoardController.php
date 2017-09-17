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
use AppBundle\Entity\EmberDataSerializerAdapter\BoardsAdapter;

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
        $boardList = $this->getDoctrine()->getRepository('AppBundle:Boards')->findAllBoards();
        $taskList =  $this->getDoctrine()->getRepository('AppBundle:Tasks')->findAll();

        $emberDataSerializerManager = $this->get('unique_libs.ember_data_serializer.manager');
        $serializedBoards = $emberDataSerializerManager->format($boardList, BoardsAdapter::MODEL_NAME_PLURAL);
        $serializedTasks =  $emberDataSerializerManager->format($taskList, BoardsAdapter::MODEL_NAME_PLURAL );
        if ($serializedBoards === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        return $serializedTasks;
    }

    /**
     * Update board
     *
     * @Rest\Put("/api/boards/{boardId}")
     * @return array
     */
    public function updateBoardById(Request $request, $boardId)
    {
        $content = json_decode($request->getContent(),true);
        $boardItem = $this->getDoctrine()->getRepository('AppBundle:Boards')->find($boardId);
        if ( $boardItem === null ){
            $response = new  View("there are no board exist", Response::HTTP_NOT_FOUND);
        }else{
            $boardItem->setName($content['board']['name']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($boardItem);
            $em->flush();
            $response = $boardItem;
        }
        return $response;
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