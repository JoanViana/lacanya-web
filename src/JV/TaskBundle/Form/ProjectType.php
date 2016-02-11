<?php

namespace JV\TaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                ,'label' => 'project.name.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('category', EntityType::class, array(
                'class' => 'JVTaskBundle:Category'
                ,'choice_label' => $category->getName()
                ,'label' => 'category.name.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('summary', TextareaType::class, array(
                ,'label' => 'project.summary.label'
                ,'required' => false
                ))
            ->add('remuneration', MoneyType::class, array(
                'label' => 'project.remuneration.label'
                ,"currency" => "EUR"
                ,"scale" => 2
                ,"required" => true
                ,"empty_data" => 0
                ))
            ->add('link', UrlType::class, array(
                'label' => 'project.link'
                ,"required" => false
                ))
            ->add('status', ChoiceType::class, array(
                //'class' => 'AppBundle:User'
                'choices' => array('project.status.proposed' => 'proposed', 
                                   'project.status.working' => 'working',
                                   'project.status.active' => 'active',
                                   'project.status.finished' => 'finished',
                                   'project.status.cancelled' => 'cancelled')
                ,'label' => 'project.status.label'
                ,'choices_as_values' => true
                ,'multiple' => false
                ,'expanded' => true
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('startDate', DateTimeType::class, array(
                "format" => "yyyy-MM-dd"
                ,'label' => 'project.startdate.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('endDate', DateTimeType::class, array(
                "format" => "yyyy-MM-dd"
                ,'label' => 'project.enddate.label'
                ,'required' => false
                ))
            ->add('enabled', CheckboxType::class, array(
                'label'    => 'project.enabled.label'
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
            'data_class' => 'JV\TaskBundle\Entity\Project'
        ));
    }
}
