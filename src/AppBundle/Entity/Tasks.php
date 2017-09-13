<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use UniqueLibs\EmberDataSerializerBundle\Interfaces\EmberDataSerializableInterface;

/**
 * Tasks
 *
 * @ORM\Table(name="tasks", indexes={@ORM\Index(name="board_id", columns={"board_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TasksRepository")
 */
class Tasks implements EmberDataSerializableInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="task_name", type="string", length=45, nullable=false)
     */
    private $taskName;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_type", type="integer", nullable=false)
     */
    private $taskType;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=40, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="intro_text", type="string", length=45, nullable=false)
     */
    private $introText;

    /**
     * @var string
     *
     * @ORM\Column(name="full_text", type="string", length=45, nullable=false)
     */
    private $fullText;

    /**
     * @var \AppBundle\Entity\Boards
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Boards")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="board_id", referencedColumnName="id")
     * })
     */
    private $board;



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
    public function setBoard(\AppBundle\Entity\Boards $board = null)
    {
        $this->board = $board;

        return $this;
    }

    /**
     * Get board
     *
     * @return \AppBundle\Entity\Boards
     */
    public function getBoard()
    {
        return $this->board;
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
