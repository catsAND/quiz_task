<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizList
 *
 * @ORM\Table(name="quiz_list", indexes={@ORM\Index(name="idx1", columns={"active"})})
 * @ORM\Entity
 */
class QuizList
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=16, nullable=false, options={"fixed"=true,"comment"="id"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false, options={"comment"="description"})
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=0, nullable=false, options={"default"="1","comment"="status; 0 - not active, 1 - active"})
     */
    private $active = '1';


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
     * @return QuizList
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
     * @return QuizList
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
}
