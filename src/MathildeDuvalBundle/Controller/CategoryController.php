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
     * Finds and displays a Job entity.
     *
     * @Route("/{slug}", name="md_category_show")
     * @Method("GET")
     */
    public function showAction(Job $job)
    {
        $deleteForm = $this->createDeleteForm($job);

        $em = $this->getDoctrine()->getManager();
        $jobChecked = $em->getRepository('EnsJobeetBundle:Job')->getActiveJob($job->getId());

        return $this->render('job/show.html.twig', array(
            'job' => $jobChecked,
            'delete_form' => $deleteForm->createView(),
        ));
    }

}