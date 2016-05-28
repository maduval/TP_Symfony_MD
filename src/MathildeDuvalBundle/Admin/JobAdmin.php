<?php
namespace MathildeDuvalBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
//use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class JobAdmin extends Admin
{
    // setup the defaut sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdAt'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('category')
            ->add('type', 'choice', array('choices' => Job::getTypes(), 'expanded' => true))
            ->add('company')
            ->add('file', 'file', array('label' => 'Company logo', 'required' => false))
            ->add('url')
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('how_to_apply')
            ->add('isPublic')
            ->add('email')
            ->add('isActivated')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('category')
            ->add('company')
            ->add('position')
            ->add('description')
            ->add('isActivated')
            ->add('isPublic')
            ->add('email')
            ->add('expiresAt')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('company')
            ->add('position')
            ->add('location')
            ->add('url')
            ->add('isActivated')
            ->add('email')
            ->add('category')
            ->add('expiresAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('category')
            ->add('type')
            ->add('company')
            ->add('webPath', 'string', array('template' => 'MathildeDuvalBundle:JobAdmin:list_image.html.twig'))
            ->add('url')
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('how_to_apply')
            ->add('isPublic')
            ->add('isActivated')
            ->add('token')
            ->add('email')
            ->add('expiresAt')
        ;
    }

    public function getBatchActions()
    {
        // retrieve the default (currently only the delete action) actions
        $actions = parent::getBatchActions();

        // check user permissions
        if($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE')) {
            $actions['extend'] = array(
                'label'            => 'Extend',
                'ask_confirmation' => true // If true, a confirmation will be asked before performing the action
            );

            $actions['deleteNeverActivated'] = array(
                'label'            => 'Delete never activated jobs',
                'ask_confirmation' => true // If true, a confirmation will be asked before performing the action
            );
        }

        return $actions;
    }

    public function batchActionDeleteNeverActivatedIsRelevant()
    {
        return true;
    }

    public function batchActionDeleteNeverActivated()
    {
        if ($this->admin->isGranted('EDIT') === false || $this->admin->isGranted('DELETE') === false) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getEntityManager();
        $nb = $em->getRepository('MathildeDuvalBundle:Job')->cleanup(60);

        if ($nb) {
            $this->get('session')->setFlash('sonata_flash_success',  sprintf('%d never activated jobs have been deleted successfully.', $nb));
        } else {
            $this->get('session')->setFlash('sonata_flash_info',  'No job to delete.');
        }

        return new RedirectResponse($this->admin->generateUrl('list',$this->admin->getFilterParameters()));
    }
}