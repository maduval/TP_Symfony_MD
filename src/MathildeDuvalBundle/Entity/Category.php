<?php

namespace MathildeDuvalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="MathildeDuvalBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\OneToMany(targetEntity="Job", mappedBy="category")
     */
    private $jobs;

    /**
     * @var int
     *
     * @ORM\OneToMany(targetEntity="CategoryAffiliate", mappedBy="category")
     */
    private $category_affiliates;

    private $activeJobs;


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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Jobs
     *
     * @param int $jobs
     * @return Category
     */
    public function setJobs ($jobs) {
        $this->jobs = $jobs;
    }

    /**
     * Get Jobs
     *
     * @return int
     */
    public function getJobs ()
    {
        return $this->jobs;
    }

    /**
     * Set categoryAffiliates
     *
     * @param int $category_affiliates
     * @return Category
     */
    public
    function setCategoryAffiliates ($category_affiliates) {
        $this->category_affiliates = $category_affiliates;
    }

    /**
     * Get categoryAffiliates
     *
     * @return int
     */
    public function getCategoryAffiliates ()
    {
        return $this->category_affiliates;
    }

    public function setActiveJobs($jobs)
    {
        $this->activeJobs = $jobs;
    }

    public function getActiveJobs()
    {
        return $this->activeJobs;
    }

    public function __toString ()
    {
        return $this->getName();
    }
}
