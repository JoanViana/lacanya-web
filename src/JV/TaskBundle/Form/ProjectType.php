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
                'label' => 'form.name'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('category', EntityType::class, array(
                'class' => 'JVTaskBundle:Category'
                ,'choice_label' => 'name'
                ,'label' => 'nav.category'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('summary', TextareaType::class, array(
                'label' => 'form.summary'
                ,'required' => false
                ))
            ->add('remuneration', MoneyType::class, array(
                'label' => 'form.remuneration'
                ,"currency" => "EUR"
                ,"scale" => 2
                ,"required" => true
                ,"empty_data" => 0
                ))
            ->add('link', UrlType::class, array(
                'label' => 'form.link'
                ,"required" => false
                ))
            ->add('status', ChoiceType::class, array(
                //'class' => 'AppBundle:User'
                'choices' => array('project.status.proposed' => 'PROPOSED', 
                                   'project.status.working' => 'WORKING',
                                   'project.status.active' => 'ACTIVE',
                                   'project.status.finished' => 'FINISHED',
                                   'project.status.cancelled' => 'CANCELLED')
                ,'label' => 'form.status'
                ,'choices_as_values' => true
                ,'multiple' => false
                ,'expanded' => false
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('startDate', DateTimeType::class, array(
                "format" => "yyyy-MM-dd"
                ,'label' => 'form.startdate'
                ,'required' => true
                ,'empty_data' => null
                ))
            ->add('endDate', DateTimeType::class, array(
                "format" => "yyyy-MM-dd"
                ,'label' => 'form.enddate'
                ,'required' => false
                ))
            ->add('enabled', CheckboxType::class, array(
                'label'    => 'form.enabled'
                ,'required' =>false
                ))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'save')
                ,'label' => 'action.save'
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
