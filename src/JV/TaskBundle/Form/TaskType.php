<?php

namespace JV\TaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'task.name.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('type', EntityType::class, array(
                'class' => 'JVTaskBundle:Type'
                ,'choice_label' => $type->getName()
                ,'label' => 'type.name.label'
                ,'required' => true
                ,'empty_data' => null
                ))
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
            ->add('summary', TextareaType::class, array(
                'label' => 'task.summary.label'
                ,'required' => false
                ))
            ->add('link', UrlType::class, array(
                'label' => 'task.link'
                ,"required" => false
                ))
            ->add('status', ChoiceType::class, array(
                //'class' => 'AppBundle:User'
                'choices' => array('task.status.proposed' => 'proposed', 
                                   'task.status.working' => 'working',
                                   'task.status.active' => 'active',
                                   'task.status.checked' => 'checked',
                                   'task.status.finished' => 'finished',
                                   'task.status.cancelled' => 'cancelled')
                ,'label' => 'task.status.label'
                ,'choices_as_values' => true
                ,'multiple' => false
                ,'expanded' => true
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('startDate', DateTimeType::class, array(
                "format" => "yyyy-MM-dd"
                ,'label' => 'task.startdate.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('endDate', DateTimeType::class, array(
                "format" => "yyyy-MM-dd"
                ,'label' => 'task.enddate.label'
                ,'required' => false
                ))
            ->add('enabled', CheckboxType::class, array(
                'label'    => 'task.enabled.label'
                ,'required' =>false
                ))
            ->add('checked', CheckboxType::class, array(
                'label'    => 'task.checked.label'
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
            'data_class' => 'JV\TaskBundle\Entity\Task'
        ));
    }
}
