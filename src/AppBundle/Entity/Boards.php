<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use UniqueLibs\EmberDataSerializerBundle\Interfaces\EmberDataSerializableInterface;
/**
 * Boards
 */
class Boards implements EmberDataSerializableInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var integer
     */
    private $count;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tasks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Boards
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return Boards
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Add task
     *
     * @param \AppBundle\Entity\Tasks $task
     *
     * @return Boards
     */
    public function addTask(\AppBundle\Entity\Tasks $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \AppBundle\Entity\Tasks $task
     */
    public function removeTask(\AppBundle\Entity\Tasks $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Relations ids
     *
     * @return array
     */
    public function relationsIds(){
        $ids = array();
        foreach ( $this->tasks AS $task ){
            $ids[] = $task->getId();
        }
        return $ids;
    }


    /**
     * Get ember data serializer
     *
     * @return string
     */
    public function getEmberDataSerializerAdapterServiceName()
    {
        return 'appbundle.ember_data_serializer_adapter.boards';
    }

}