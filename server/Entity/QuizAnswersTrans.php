<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * QuizAnswersTrans
 *
 * @ORM\Table(name="quiz_answers_trans", indexes={@ORM\Index(name="FK_quiz_answers_trans_quiz_questions", columns={"question_id"}), @ORM\Index(name="IDX_2A44497FBF396750", columns={"id"})})
 * @ORM\Entity
 */
class QuizAnswersTrans
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
     * @ORM\Column(name="answer", type="text", length=65535, nullable=true, options={"comment"="text"})
     */
    private $answer;

    /**
     * @var \QuizQuestions
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="QuizQuestions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     * })
     */
    private $question;

    /**
     * @var \QuizAnswers
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="QuizAnswers")
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
     * @return QuizAnswersTrans
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
     * Set answer.
     *
     * @param string|null $answer
     *
     * @return QuizAnswersTrans
     */
    public function setAnswer($answer = null)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer.
     *
     * @return string|null
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set question.
     *
     * @param \QuizQuestions $question
     *
     * @return QuizAnswersTrans
     */
    public function setQuestion(\QuizQuestions $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question.
     *
     * @return \QuizQuestions
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set id.
     *
     * @param \QuizAnswers $id
     *
     * @return QuizAnswersTrans
     */
    public function setId(\QuizAnswers $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id.
     *
     * @return \QuizAnswers
     */
    public function getId()
    {
        return $this->id;
    }
}
