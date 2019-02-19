<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizQuestionsTrans
 *
 * @ORM\Table(name="quiz_questions_trans", indexes={@ORM\Index(name="IDX_CE5D3490BF396750", columns={"id"})})
 * @ORM\Entity
 */
class QuizQuestionsTrans
{
    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=2, nullable=false, options={"fixed"=true,"comment"="language"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $lang;

    /**
     * @var string|null
     *
     * @ORM\Column(name="question", type="text", length=65535, nullable=true, options={"comment"="text"})
     */
    private $question;

    /**
     * @var \Api\Entity\QuizQuestions
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Api\Entity\QuizQuestions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;


    /**
     * Set lang.
     *
     * @param string $lang
     *
     * @return QuizQuestionsTrans
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang.
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set question.
     *
     * @param string|null $question
     *
     * @return QuizQuestionsTrans
     */
    public function setQuestion($question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question.
     *
     * @return string|null
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set id.
     *
     * @param \Api\Entity\QuizQuestions $id
     *
     * @return QuizQuestionsTrans
     */
    public function setId(\Api\Entity\QuizQuestions $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id.
     *
     * @return \Api\Entity\QuizQuestions
     */
    public function getId()
    {
        return $this->id;
    }
}
