<?php

namespace JV\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;


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
                'attr' => array('class' => 'btn btn-green')
                ,'label' => 'button.save'
                ))
            ->add('reset', ResetType::class, array(
                'attr' => array('class' => 'btn reset')
                ,'label' => 'button.reset'
                ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JV\WebBundle\Entity\Contact',
            'translation_domain' => 'JVWebBundle'
            
        ));
    }
}
