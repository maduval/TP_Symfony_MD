<?php

namespace MathildeDuvalBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MathildeDuvalBundle\Entity\Job;
use MathildeDuvalBundle\Form\JobType;

/**
 * Job controller.
 *
 * @Route("/md_job")
 */
class JobController extends Controller
{
    /**
     * Lists all Job entities.
     *
     * @Route("/", name="md_job_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jobs = $em->getRepository('MathildeDuvalBundle:Job')->findAll();

        return $this->render('job/index.html.twig', array(
            'jobs' => $jobs,
        ));
    }

    /**
     * Creates a new Job entity.
     *
     * @Route("/new", name="md_job_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $job = new Job();
        $form = $this->createForm('MathildeDuvalBundle\Form\JobType', $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('md_job_show', array('id' => $job->getId()));
        }

        return $this->render('job/new.html.twig', array(
            'job' => $job,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Job entity.
     *
     * @Route("/{company}/{location}/{id}/{position}", requirements={"id" = "\d+"}, name="md_job_show")
     * @Method("GET")
     */
    public function showAction(Job $job)
    {
        $deleteForm = $this->createDeleteForm($job);

        return $this->render('job/show.html.twig', array(
            'job' => $job,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Job entity.
     *
     * @Route("/{id}/edit", name="md_job_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Job $job)
    {
        $deleteForm = $this->createDeleteForm($job);
        $editForm = $this->createForm('MathildeDuvalBundle\Form\JobType', $job);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('md_job_edit', array('id' => $job->getId()));
        }

        return $this->render('job/edit.html.twig', array(
            'job' => $job,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Job entity.
     *
     * @Route("/{id}", name="md_job_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Job $job)
    {
        $form = $this->createDeleteForm($job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($job);
            $em->flush();
        }

        return $this->redirectToRoute('md_job_index');
    }

    /**
     * Creates a form to delete a Job entity.
     *
     * @param Job $job The Job entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Job $job)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('md_job_delete', array('id' => $job->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
