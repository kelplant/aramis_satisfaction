<?php

namespace Satisfaction\FormBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Satisfaction\FormBundle\Entity\Ticket;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TicketTypeView extends BaseType
{
    public function buildForm(FormBuilderInterface $builder,  array $options)
    {
        $choice_10 = array(
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10',
        );

        $builder
            ->add('NumTicket', IntegerType::class, array(
                'label' => 'Numéro Ticket',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'readonly' => true,
                )
            ))
            ->add('Sujet', TextType::class, array(
                'label' => 'Sujet',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'readonly' => true,
                ),
            ))
            ->add('Description', TextareaType::class, array(
                'label' => 'Description',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'rows' => '5',
                    'readonly' => true,
                ),
            ))
            ->add('Satisfaction', ChoiceType::class, array(
                'label' => 'Satisfaction',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $choice_10,
                'expanded' => true,
                'multiple' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'readonly' => true,
                )
            ))
            ->add('Conformite', ChoiceType::class, array(
                'label' => 'Conformité',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $choice_10,
                'expanded' => true,
                'multiple' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'readonly' => true,
                )
            ))
            ->add('Accompagnement', ChoiceType::class, array(
                'label' => 'Accompagnement',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $choice_10,
                'expanded' => true,
                'multiple' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'disabled'=> true,
                    'readonly' => true,
                )
            ))
            ->add('Delais', ChoiceType::class, array(
                'label' => 'Délais',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $choice_10,
                'expanded' => true,
                'multiple' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'readonly' => true,
                )
            ))
            ->add('Commentaires', TextareaType::class, array(
                'label' => 'Commentaires',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'readonly' => true,
                )
            ))
            ->add('numticket', HiddenType::class, array(
                'label' => 'numticket',
            ))
            ->add('id', 'hidden', array(
                'label' => 'id',
            ))
            ->add('Modifier', SubmitType::class, array(
                'label' => 'Modifier',
                'attr' => array(
                    'class' => 'btn btn-warning',
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Satisfaction\FormBundle\Entity\Ticket',
        ));
    }
}
?>
