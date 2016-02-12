<?php

namespace JV\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, array(
                'label' => 'contact.firstname.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('lastName', TextType::class, array(
                'label' => 'contact.lastname.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('email', EmailType::class, array(
                'label' => 'contact.email.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('subject', TextType::class, array(
                'label' => 'contact.subject.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('body', TextareaType::class, array(
                'label' => 'contact.body.label'
                ,'required' => false
                ))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'save')
                ,'label' => 'button.save'
                ))
            ->add('reset', ResetType::class, array(
                'attr' => array('class' => 'reset')
                ,'label' => 'button.reset'
                ))
        ;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'contact';
    }
}
