<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use UniqueLibs\EmberDataSerializerBundle\Interfaces\EmberDataSerializableInterface;
/**
 * Tasks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TasksRepository")
 */
class Tasks implements EmberDataSerializableInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $taskName;

    /**
     * @var integer
     */
    private $taskType;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $introText;

    /**
     * @var string
     */
    private $fullText;

    /**
     * @var \AppBundle\Entity\Boards
     */
    private $boards;


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
     * Set taskName
     *
     * @param string $taskName
     *
     * @return Tasks
     */
    public function setTaskName($taskName)
    {
        $this->taskName = $taskName;

        return $this;
    }

    /**
     * Get taskName
     *
     * @return string
     */
    public function getTaskName()
    {
        return $this->taskName;
    }

    /**
     * Set taskType
     *
     * @param integer $taskType
     *
     * @return Tasks
     */
    public function setTaskType($taskType)
    {
        $this->taskType = $taskType;

        return $this;
    }

    /**
     * Get taskType
     *
     * @return integer
     */
    public function getTaskType()
    {
        return $this->taskType;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Tasks
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set introText
     *
     * @param string $introText
     *
     * @return Tasks
     */
    public function setIntroText($introText)
    {
        $this->introText = $introText;

        return $this;
    }

    /**
     * Get introText
     *
     * @return string
     */
    public function getIntroText()
    {
        return $this->introText;
    }

    /**
     * Set fullText
     *
     * @param string $fullText
     *
     * @return Tasks
     */
    public function setFullText($fullText)
    {
        $this->fullText = $fullText;

        return $this;
    }

    /**
     * Get fullText
     *
     * @return string
     */
    public function getFullText()
    {
        return $this->fullText;
    }

    /**
     * Set board
     *
     * @param \AppBundle\Entity\Boards $board
     *
     * @return Tasks
     */
    public function setBoard(\AppBundle\Entity\Boards $boards = null)
    {
        $this->boards = $boards;

        return $this;
    }

    /**
     * Get board
     *
     * @return \AppBundle\Entity\Boards
     */
    public function getBoard()
    {
        return $this->boards;
    }

    /**
     * Get ember data serializer
     *
     * @return string
     */
    public function getEmberDataSerializerAdapterServiceName()
    {
        return 'appbundle.ember_data_serializer_adapter.tasks';
    }


}

