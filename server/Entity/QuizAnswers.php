<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizAnswers
 *
 * @ORM\Table(name="quiz_answers", indexes={@ORM\Index(name="idx2", columns={"active"}), @ORM\Index(name="idx1", columns={"question_id"})})
 * @ORM\Entity
 */
class QuizAnswers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="smallint", nullable=false, options={"unsigned"=true,"comment"="answer id"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false, options={"comment"="answer description"})
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=0, nullable=false, options={"default"="1","comment"="status; 0 - not active, 1 - active"})
     */
    private $active = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="correct", type="string", length=0, nullable=false, options={"comment"="0 - not correct, 1 - answer correct"})
     */
    private $correct = '0';

    /**
     * @var \Api\Entity\QuizQuestions
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Api\Entity\QuizQuestions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     * })
     */
    private $question;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Api\Entity\QuizUsers", mappedBy="answer")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id.
     *
     * @param int $id
     *
     * @return QuizAnswers
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return QuizAnswers
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set active.
     *
     * @param string $active
     *
     * @return QuizAnswers
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set correct.
     *
     * @param string $correct
     *
     * @return QuizAnswers
     */
    public function setCorrect($correct)
    {
        $this->correct = $correct;

        return $this;
    }

    /**
     * Get correct.
     *
     * @return string
     */
    public function getCorrect()
    {
        return $this->correct;
    }

    /**
     * Set question.
     *
     * @param \Api\Entity\QuizQuestions $question
     *
     * @return QuizAnswers
     */
    public function setQuestion(\Api\Entity\QuizQuestions $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question.
     *
     * @return \Api\Entity\QuizQuestions
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Add user.
     *
     * @param \Api\Entity\QuizUsers $user
     *
     * @return QuizAnswers
     */
    public function addUser(\Api\Entity\QuizUsers $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user.
     *
     * @param \Api\Entity\QuizUsers $user
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUser(\Api\Entity\QuizUsers $user)
    {
        return $this->user->removeElement($user);
    }

    /**
     * Get user.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }
}
