<?php

namespace JV\TaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssignmentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('project', EntityType::class, array(
                'class' => 'JVTaskBundle:Project'
                ,'choice_label' => $project->getName()
                ,'label' => 'project.name.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('user', EntityType::class, array(
                'class' => 'JVTaskBundle:User'
                ,'choice_label' => $user->getUsername()
                ,'label' => 'user.username.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('function', ChoiceType::class, array(
                //'class' => 'AppBundle:User'
                'choices' => array('assignment.function.management' => 'management', 
                                   'assignment.function.field' => 'field',
                                   'assignment.function.relations' => 'relations',
                                   'assignment.function.presentation' => 'presentation',
                                   'assignment.function.technical' => 'technical',
                                   'assignment.function.logistics' => 'logistics',
                                   'assignment.function.other' => 'other')
                ,'label' => 'assignment.function.label'
                ,'choices_as_values' => true
                ,'multiple' => true
                ,'expanded' => true
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('isActive', CheckboxType::class, array(
                'label'    => 'assignment.isactive.label'
                ,'required' => false
                ,'empty_data' => false
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
            'data_class' => 'JV\TaskBundle\Entity\Assignment'
        ));
    }
}
