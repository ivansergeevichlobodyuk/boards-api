<?php
namespace AppBundle\Repository;


use Doctrine\ORM\Query;

/**
 * Class TasksRepository
 */
class BoardsRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Finds all boards
     *
     * @return array
     */
    public function findAllBoards()
    {

        $result = $this->createQueryBuilder('b')
            ->leftJoin('b.tasks','t')
            ->addSelect('t')
            ->getQuery()
            ->getResult();

        return $result;
//         echo "<pre>"; print_r($result); die;
//
//        $results = $this->findAll();
//
//        foreach ( $results AS $result ){
//            foreach ( $result->getTasks() as $task) {
//                echo "111 <pre>"; print_r($task->getTaskName()); die;
//
//            }
//        }
//
//
//            //echo "RESULT <pre>"; print_r($result[0]); die;
//
//        $result = $this->getEntityManager()->getConnection()->executeQuery('SELECT * from boards LEFT JOIN tasks ON tasks.board_id = boards.id')->fetchAll();
//        $response = array();
//        foreach ( $result AS $data ){
//            $links[(int)$data['board_id']][] = (int)$data['id'];
//            $response['board'][(int)$data['board_id']] = array(
//                'id' => (int)$data['board_id'],
//                'name' => $data['name'],
//                'count' => $data['count'],
//                'task' => array($data['id'])
//            );
//            $response['task'][] = array(
//                'id' => (int)$data['id'],
//                'taskName' => $data['task_name'],
//                'taskType' => $data['task_type'],
//                'introText' => $data['intro_text'],
//                'fullText'  => $data['full_text']
//            );
//        }
//
//        foreach ( $response['board'] As $key => $data ){
//            $response['board'][(int)$key]['task'] = $links[$key];
//        }
//        $response['board'] = array_values($response['board']);
//         return $response;
    }

    /**
     * Finds board by id
     *
     * @param $id
     * @return null|object
     */
    public function findBoardById($id){

        $item = $this->find($id);
        $data = array( 'board' => array( 'id' => $item->getId(), 'name' => $item->getName(), 'count' => $item->getCount() ) );
        return $data;
    }

}