<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * QuizListTrans
 *
 * @ORM\Table(name="quiz_list_trans", indexes={@ORM\Index(name="IDX_E0DDAD82BF396750", columns={"id"})})
 * @ORM\Entity
 */
class QuizListTrans
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
     * @ORM\Column(name="quiz", type="text", length=65535, nullable=true, options={"comment"="text"})
     */
    private $quiz;

    /**
     * @var \QuizList
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="QuizList")
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
     * @return QuizListTrans
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
     * Set quiz.
     *
     * @param string|null $quiz
     *
     * @return QuizListTrans
     */
    public function setQuiz($quiz = null)
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * Get quiz.
     *
     * @return string|null
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * Set id.
     *
     * @param \QuizList $id
     *
     * @return QuizListTrans
     */
    public function setId(\QuizList $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id.
     *
     * @return \QuizList
     */
    public function getId()
    {
        return $this->id;
    }
}
