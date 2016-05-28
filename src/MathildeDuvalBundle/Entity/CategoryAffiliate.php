<?php

namespace MathildeDuvalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryAffiliate
 *
 * @ORM\Table(name="category_affiliate")
 * @ORM\Entity(repositoryClass="MathildeDuvalBundle\Repository\CategoryAffiliateRepository")
 */
class CategoryAffiliate
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="category_affiliates")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Affiliate", inversedBy="category_affiliates")
     * @ORM\JoinColumn(name="affiliate_id", referencedColumnName="id")
     */
    private $affiliate;

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
     * Set category
     *
     * @param int $category
     * @return CategoryAffiliate
     */
    public function setCategory ($category) {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return int
     */
    public
    function getCategory ()
    {
        return $this->category;
    }

    /**
     * Set Affiliate
     *
     * @param int $affiliate
     * @return CategoryAffiliate
     */
    public function setAffiliate ($affiliate) {
        $this->affiliate = $affiliate;
    }

    /**
     * Get Affiliate
     *
     * @return int
     */
    public function getAffiliate ()
    {
        return $this->affiliate;
    }
}
