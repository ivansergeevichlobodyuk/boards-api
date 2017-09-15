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
use AppBundle\Entity\Tasks;
use AppBundle\Entity\Boards;
use AppBundle\Entity\EmberDataSerializerAdapter\TasksAdapter;

class TaskController extends FOSRestController
{
    /**
     * Gets board's tasks
     *
     * @Rest\Get("/api/boards/{id}/task/")
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
     * @Rest\Post("/api/tasks")
     */
    public function addTask(Request $request){
        $task = new Tasks();
        $boards = new Boards();
        $content = json_decode($request->getContent(),true);

        $board = $this->getDoctrine()->getRepository('AppBundle:Boards')->find($content['task']['board']);

        $task->setBoard($board);
        $task->setTaskName($content['task']['taskName']);
        $task->setFullText($content['task']['taskName']);
        $task->setIntroText($content['task']['taskName']);
        $task->setTaskType($content['task']['taskName']);
        $task->setTitle($content['task']['taskName']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();
        return array('task' => array('id' => $task->getId(),'taskName' => $task->getTaskName() ));
    }

    /**
     * Write task data
     *
     * @param Tasks $task
     * @param array $data
     */
    private function _writeTaskData(Tasks $task, array $data){
        $board = $this->getDoctrine()->getRepository('AppBundle:Boards')->find($data['task']['board']);

        $task->setBoard($board);
        $task->setTaskName($data['task']['taskName']);
        $task->setFullText($data['task']['taskName']);
        $task->setIntroText($data['task']['taskName']);
        $task->setTaskType($data['task']['taskName']);
        $task->setTitle($data['task']['taskName']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();
        return array('task' => array('id' => $task->getId(),'taskName' => $task->getTaskName() ));

    }

    /**
     * Updates task
     *
     * @param $taskId
     * @Rest\Put("/api/tasks/{taskId}")
     * @return array
     */
    public function updateTask($taskId, Request $request){
        $task = $this->getDoctrine()->getRepository('AppBundle:Tasks')
            ->find($taskId);
        $content = json_decode($request->getContent(),true);
        return $this->_writeTaskData( $task, $content );
    }

    /**
     * Gets task on board id
     *
     * @Rest\Get("/api/tasks/{taskId}")
     */
    public function getTasksById($taskId)
    {
        $task = $this->getDoctrine()->getRepository('AppBundle:Tasks')
            ->find($taskId);
        return array('task'=>array('id' => $task->getId()));
    }

}