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
        return $this->_writeTaskData($task, $content);
    }

    /**
     * Updates task
     *
     * @param Request $request
     * @param $taskId
     * @Rest\Put("/api/tasks/{taskId}")
     * @return array
     */
    public function updateTask(Request $request,$taskId ){

        $task = $this->getDoctrine()->getRepository('AppBundle:Tasks')
            ->find($taskId);
        $data = (array)json_decode($request->getContent());

        $data['task'] = (array)$data['task'];
        return $this->_writeTaskData( $task, $data );
    }


    /**
     * @param Tasks $task
     * @param array $data
     * @return array
     */
    private function _writeTaskData(Tasks $task, array $data){
        $board = $this->getDoctrine()->getRepository('AppBundle:Boards')->find($data['task']['board']);
        $validator = $this->get('validator');

        $task->setBoard($board);
        $task->setTaskName($data['task']['taskName']);
        $task->setFullText($data['task']['taskName']);
        $task->setIntroText($data['task']['taskName']);
        $task->setTaskType($data['task']['taskName']);
        $task->setTitle($data['task']['taskName']);

        $errors = $validator->validate($task);
        if ( count($errors) > 0  ){
            $error_data = array('errors' => array());
            $c = 0;

            foreach ($errors AS $error){
                $error_data['errors'][$c]['detail'] = $error->getMessage();
                $error_data['errors'][$c]['source'] = array( 'pointer' => $error->getPropertyPath() );
                $c++;
            }
            $response = new Response(json_encode($error_data),422);
        }else{
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            $response = array('task' => array('id' => $task->getId(),'taskName' => $task->getTaskName() ));
        }
        return $response;
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