<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizUsersAnswers
 *
 * @ORM\Table(name="quiz_users_answers", indexes={@ORM\Index(name="idx2", columns={"answer_id"}), @ORM\Index(name="idx1", columns={"question_id"})})
 * @ORM\Entity
 */
class QuizUsersAnswers
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=16, nullable=false, options={"fixed"=true,"comment"="user id"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="question_id", type="string", length=16, nullable=false, options={"fixed"=true,"comment"="question id"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $questionId;

    /**
     * @var int
     *
     * @ORM\Column(name="answer_id", type="smallint", nullable=false, options={"unsigned"=true,"comment"="answer id"})
     */
    private $answerId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="answer_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP","comment"="answer date"})
     */
    private $answerDate = 'CURRENT_TIMESTAMP';


    /**
     * Set userId.
     *
     * @param string $userId
     *
     * @return QuizUsersAnswers
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId.
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set questionId.
     *
     * @param string $questionId
     *
     * @return QuizUsersAnswers
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;

        return $this;
    }

    /**
     * Get questionId.
     *
     * @return string
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * Set answerId.
     *
     * @param int $answerId
     *
     * @return QuizUsersAnswers
     */
    public function setAnswerId($answerId)
    {
        $this->answerId = $answerId;

        return $this;
    }

    /**
     * Get answerId.
     *
     * @return int
     */
    public function getAnswerId()
    {
        return $this->answerId;
    }

    /**
     * Set answerDate.
     *
     * @param \DateTime $answerDate
     *
     * @return QuizUsersAnswers
     */
    public function setAnswerDate($answerDate)
    {
        $this->answerDate = $answerDate;

        return $this;
    }

    /**
     * Get answerDate.
     *
     * @return \DateTime
     */
    public function getAnswerDate()
    {
        return $this->answerDate;
    }
}
