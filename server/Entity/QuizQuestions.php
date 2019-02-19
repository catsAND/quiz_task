<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * QuizQuestions
 *
 * @ORM\Table(name="quiz_questions", indexes={@ORM\Index(name="idx2", columns={"active"}), @ORM\Index(name="idx3", columns={"weight"}), @ORM\Index(name="idx1", columns={"quiz_id"})})
 * @ORM\Entity
 */
class QuizQuestions
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=16, nullable=false, options={"fixed"=true,"comment"="question id"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false, options={"comment"="question description"})
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="smallint", nullable=false, options={"unsigned"=true,"comment"="order"})
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=0, nullable=false, options={"default"="1","comment"="status; 0 - not active, 1 - active"})
     */
    private $active = '1';

    /**
     * @var \QuizList
     *
     * @ORM\ManyToOne(targetEntity="QuizList")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="quiz_id", referencedColumnName="id")
     * })
     */
    private $quiz;


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
     * Set description.
     *
     * @param string $description
     *
     * @return QuizQuestions
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
     * Set weight.
     *
     * @param int $weight
     *
     * @return QuizQuestions
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight.
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set active.
     *
     * @param string $active
     *
     * @return QuizQuestions
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
     * Set quiz.
     *
     * @param \QuizList|null $quiz
     *
     * @return QuizQuestions
     */
    public function setQuiz(\QuizList $quiz = null)
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * Get quiz.
     *
     * @return \QuizList|null
     */
    public function getQuiz()
    {
        return $this->quiz;
    }
}
