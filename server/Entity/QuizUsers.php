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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @var \Api\Entity\QuizList
     *
     * @ORM\ManyToOne(targetEntity="Api\Entity\QuizList")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="quiz_id", referencedColumnName="id")
     * })
     */
    private $quiz;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Api\Entity\QuizAnswers", inversedBy="user")
     * @ORM\JoinTable(name="quiz_users_answers",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
     *   }
     * )
     */
    private $answer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answer = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add answer.
     *
     * @param \Api\Entity\QuizAnswers $answer
     *
     * @return QuizUsers
     */
    public function addAnswer(\Api\Entity\QuizAnswers $answer)
    {
        $this->answer[] = $answer;

        return $this;
    }

    /**
     * Remove answer.
     *
     * @param \Api\Entity\QuizAnswers $answer
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAnswer(\Api\Entity\QuizAnswers $answer)
    {
        return $this->answer->removeElement($answer);
    }

    /**
     * Get answer.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
