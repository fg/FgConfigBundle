<?php

namespace Fg\Bundle\ConfigBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fg\Bundle\ConfigBundle\Entity\Setting;
use Fg\Bundle\ConfigBundle\Form\SettingType;

/**
 * Setting controller.
 *
 * @Route("/management/setting")
 */
class SettingController extends Controller
{

    /**
     * Lists all Setting entities.
     *
     * @Route("/", name="management_setting")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FgConfigBundle:Setting')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Setting entity.
     *
     * @Route("/", name="management_setting_create")
     * @Method("POST")
     * @Template("FgConfigBundle:Setting:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Setting();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('management_setting_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Setting entity.
     *
     * @param Setting $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Setting $entity)
    {
        $form = $this->createForm(new SettingType(), $entity, array(
            'action' => $this->generateUrl('management_setting_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Setting entity.
     *
     * @Route("/new", name="management_setting_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Setting();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Setting entity.
     *
     * @Route("/{id}", name="management_setting_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FgConfigBundle:Setting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Setting entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Setting entity.
     *
     * @Route("/{id}/edit", name="management_setting_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FgConfigBundle:Setting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Setting entity.');
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
    * Creates a form to edit a Setting entity.
    *
    * @param Setting $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Setting $entity)
    {
        $form = $this->createForm(new SettingType(), $entity, array(
            'action' => $this->generateUrl('management_setting_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Setting entity.
     *
     * @Route("/{id}", name="management_setting_update")
     * @Method("PUT")
     * @Template("FgConfigBundle:Setting:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FgConfigBundle:Setting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Setting entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('management_setting_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Setting entity.
     *
     * @Route("/{id}", name="management_setting_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FgConfigBundle:Setting')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Setting entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('management_setting'));
    }

    /**
     * Creates a form to delete a Setting entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('management_setting_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
