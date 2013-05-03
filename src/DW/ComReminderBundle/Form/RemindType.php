<?php

namespace DW\ComReminderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RemindType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('text')
            ->add('comment')
            ->add('number')
            ->add('rate')
            ->add('type')
            ->add('category')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DW\ComReminderBundle\Entity\Remind'
        ));
    }

    public function getName()
    {
        return 'dw_comreminderbundle_remindtype';
    }
}
