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

class TaskController extends FOSRestController
{
    /**
     * Gets board's tasks
     *
     * @Rest\Get("/api/boards/{id}/tasks/")
     */
    public function getTasksByBoardId($id)
    {
        $restResult = $this->getDoctrine()->getRepository('AppBundle:Tasks')->findBy(array('board' => $id));
        if ($restResult === null) {
            return new View("there are no board id = {$id} exist", Response::HTTP_NOT_FOUND);
        }
        return $restResult;
    }

    /**
     * Gets task on board id
     *
     * @Rest\Get("/api/boards/{boardId}/tasks/{taskId}")
     */
    public function getTasksById($boardId, $taskId)
    {
        $restResult = $this->getDoctrine()->getRepository('AppBundle:Tasks')
            ->findTaskByBoardIdTaskId($boardId, $taskId);
        if (empty($restResult)) {
            return new View("there are no task with id $taskId under board with $boardId exist", Response::HTTP_NOT_FOUND);
        }

        return $restResult;
    }

}