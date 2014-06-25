<?php

namespace Tagged\FoosballBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tagged\FoosballBundle\Entity\FoosballGame;
use Tagged\FoosballBundle\Form\FoosballGameType;

/**
 * FoosballGame controller.
 *
 * @Route("/")
 */
class FoosballGameController extends Controller
{
    /**
     * Upload List
     *
     * @Route("/", name="_upload")
     * @Method("POST")
     */
    public function UploadCsv() {
        foreach($this->getRequest()->files as $file) { 
            if (($handle = fopen($file->getRealPath(), "r")) !== FALSE) {
                
                $em = $this->getDoctrine()->getManager();
                while(($row = fgetcsv($handle)) !== FALSE) {
                    //var_dump($row[1]);
                    if(is_numeric($row[1]))
                    {
                        var_dump($row);
                        $entity = new FoosballGame();
                        $entity->setPlayer1($row[0]);
                        $entity->setPlayer1Score(intval($row[1]));
                        $entity->setPlayer2($row[2]);
                        $entity->setPlayer2Score(intval($row[3]));                    
                        $em->persist($entity);
                    }
                }
                $em->flush();
            }
        }
        //return $this->redirect($this->generateUrl('_list'));
        //return response.
    }    
    
    /**
     * Lists all FoosballGame entities.
     *
     * @Route("/", name="_list")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TaggedFoosballBundle:FoosballGame')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new FoosballGame entity.
     *
     * @Route("/", name="_create")
     * @Method("POST")
     * @Template("TaggedFoosballBundle:FoosballGame:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new FoosballGame();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a FoosballGame entity.
    *
    * @param FoosballGame $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(FoosballGame $entity)
    {
        $form = $this->createForm(new FoosballGameType(), $entity, array(
            'action' => $this->generateUrl('_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new FoosballGame entity.
     *
     * @Route("/new", name="_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new FoosballGame();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a FoosballGame entity.
     *
     * @Route("/{id}", name="_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaggedFoosballBundle:FoosballGame')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FoosballGame entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing FoosballGame entity.
     *
     * @Route("/{id}/edit", name="_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaggedFoosballBundle:FoosballGame')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FoosballGame entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a FoosballGame entity.
    *
    * @param FoosballGame $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FoosballGame $entity)
    {
        $form = $this->createForm(new FoosballGameType(), $entity, array(
            'action' => $this->generateUrl('_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing FoosballGame entity.
     *
     * @Route("/{id}", name="_update")
     * @Method("PUT")
     * @Template("TaggedFoosballBundle:FoosballGame:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaggedFoosballBundle:FoosballGame')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FoosballGame entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a FoosballGame entity.
     *
     * @Route("/{id}", name="_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TaggedFoosballBundle:FoosballGame')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FoosballGame entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl(''));
    }

    /**
     * Creates a form to delete a FoosballGame entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
