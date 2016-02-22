<?php

namespace Satisfaction\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Satisfaction\FormBundle\Entity\Client;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NumTicket', 'integer', array(
                'label' => 'Numéro Ticket',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('Sujet', 'text', array(
                'label' => 'Sujet',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('Description', 'textarea', array(
                'label' => 'Description',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('Satisfaction', 'choice', array(
                'label' => 'Satisfaction',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6','7' => '7', '8' => '8', '9' => '9', '10' => '10'),
                'expanded' => true,
                'multiple' => false,
                'data' => 5,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('Conformite', 'choice', array(
                'label' => 'Conformité',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'),
                'expanded' => true,
                'multiple' => false,
                'data' => 3,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('Accompagnement', 'choice', array(
                'label' => 'Accompagnement',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'),
                'expanded' => true,
                'multiple' => false,
                'data' => 3,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('Delais', 'choice', array(
                'label' => 'Délais',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'),
                'expanded' => true,
                'multiple' => false,
                'data' => 3,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('Commentaires', 'textarea', array(
                'label' => 'Commentaires',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('Envoyer', 'submit', array(
                'label' => 'Envoyer',
                'attr' => array(
                    'class' => 'btn btn-success'
                )
            ))
        ;
    }

    public function getName()
    {
        return 'ticket';
    }

//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => 'Satisfaction\FormBundle\Entity\Ticket',
//        ));
//    }
}
?>
