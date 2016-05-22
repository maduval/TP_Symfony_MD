<?php

namespace MathildeDuvalBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use MathildeDuvalBundle\Entity\Category;

/**
 * Category controller.
 *
 * @Route("/md_category")
 */
class CategoryController extends Controller
{
    /**
     *
     * @Route("/{slug}", name="md_category_show")
     * @Method("GET")
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $category = $em->getRepository('MathildeDuvalBundle:Category')->findOneBySlug($slug);

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $category->setActiveJobs($em->getRepository('MathildeDuvalBundle:Job')->getActiveJobs($category->getId()));

        return $this->render('category/show.html.twig', array(
            'category' => $category,
        ));
    }

}