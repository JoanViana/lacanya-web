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
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use JV\TaskBundle\Entity\Category;

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
                'label' => 'project.name.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('category', EntityType::class, array(
                'class' => 'JVTaskBundle:Category'
                ,'choice_label' => 'name'
                ,'label' => 'category.name.label'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('summary', TextareaType::class, array(
                'label' => 'project.summary.label'
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
                'choices' => array('project.status.proposed' => 'PROPOSED', 
                                   'project.status.working' => 'WORKING',
                                   'project.status.active' => 'ACTIVE',
                                   'project.status.finished' => 'FINISHED',
                                   'project.status.cancelled' => 'CANCELLED')
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
            'data_class' => 'JV\TaskBundle\Entity\Project',
            'translation_domain' => 'JVTaskBundle'
        ));
    }
}
