<?php

namespace JV\TaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'form.email'
                ,'translation_domain' => 'FOSUserBundle'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('username', TextType::class, array(
                'label' => 'form.username'
                ,'translation_domain' => 'FOSUserBundle'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('firstName', TextType::class, array(
                'label' => 'user.firstname.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('lastName', TextType::class, array(
                'label' => 'user.lastname.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('phone', NumberType::class, array(
                'label' => 'user.phone.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('enabled', CheckboxType::class, array(
                'label'    => 'user.enabled.label'
                ,'required' =>false
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
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JV\TaskBundle\Entity\User'
        ));
    }
}
