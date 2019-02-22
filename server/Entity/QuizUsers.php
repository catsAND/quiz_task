<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizUsers
 *
 * @ORM\Table(name="quiz_users", indexes={@ORM\Index(name="idx1", columns={"quiz_id"})})
 * @ORM\Entity
 */
class QuizUsers
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=16, nullable=false, options={"fixed"=true,"comment"="user id"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false, options={"comment"="user name"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=false, options={"fixed"=true,"comment"="user ip"})
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP","comment"="timestamp when created"})
     */
    private $createDate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finish_date", type="datetime", nullable=false, options={"default"="0000-00-00 00:00:00","comment"="timestamp when user finished quiz"})
     */
    private $finishDate = '0000-00-00 00:00:00';

    /**
     * @var int
     *
     * @ORM\Column(name="corrected", type="smallint", nullable=false, options={"unsigned"=true,"comment"="corrected answer count"})
     */
    private $corrected = '0';

    /**
     * @var \Api\Entity\QuizList
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\QuizList")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="quiz_id", referencedColumnName="id")
     * })
     */
    private $quiz;

    /**
     * Set id.
     *
     * @param string $id
     *
     * @return QuizUsers
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return QuizUsers
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set ip.
     *
     * @param string $ip
     *
     * @return QuizUsers
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip.
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set createDate.
     *
     * @param \DateTime $createDate
     *
     * @return QuizUsers
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate.
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set finishDate.
     *
     * @param \DateTime $finishDate
     *
     * @return QuizUsers
     */
    public function setFinishDate($finishDate)
    {
        $this->finishDate = $finishDate;

        return $this;
    }

    /**
     * Get finishDate.
     *
     * @return \DateTime
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * Set corrected.
     *
     * @param int $corrected
     *
     * @return QuizUsers
     */
    public function setCorrected($corrected)
    {
        $this->corrected = $corrected;

        return $this;
    }

    /**
     * Get corrected.
     *
     * @return int
     */
    public function getCorrected()
    {
        return $this->corrected;
    }

    /**
     * Set quiz.
     *
     * @param \Api\Entity\QuizList|null $quiz
     *
     * @return QuizUsers
     */
    public function setQuiz(\Api\Entity\QuizList $quiz = null)
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * Get quiz.
     *
     * @return \Api\Entity\QuizList|null
     */
    public function getQuiz()
    {
        return $this->quiz;
    }
}
