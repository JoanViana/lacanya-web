<?php

namespace JV\TaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use JV\TaskBundle\Entity\User;
use JV\TaskBundle\Entity\Project;
use JV\TaskBundle\Entity\Type;


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
                ,'choice_label' => 'name'
                ,'label' => 'type.name.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('project', EntityType::class, array(
                'class' => 'JVTaskBundle:Project'
                ,'choice_label' => 'name'
                ,'label' => 'project.name.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('user', EntityType::class, array(
                'class' => 'JVTaskBundle:User'
                ,'choice_label' => 'username'
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
                'choices' => array('task.status.proposed' => 'PROPOSED', 
                                   'task.status.working' => 'WORKING',
                                   'task.status.active' => 'ACTIVE',
                                   'task.status.checked' => 'CHECKED',
                                   'task.status.finished' => 'FINISHED',
                                   'task.status.cancelled' => 'CANCELLED')
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
            'data_class' => 'JV\TaskBundle\Entity\Task',
            'translation_domain' => 'JVTaskBundle'
        ));
    }
}
