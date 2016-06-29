<?php

namespace Satisfaction\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Satisfaction\FormBundle\Entity\Client;



class TicketTypeView extends AbstractType
{
    private $choices_5;

    private $choices_10;

    public function __construct(array $choices_5,$choices_10)
    {
        $this->choices_5 = $choices_5;
        $this->choices_10 = $choices_10;
    }

    public function buildForm(FormBuilderInterface $builder,  array $options)
    {

        $builder
            ->add('NumTicket', 'integer', array(
                'label' => 'Numéro Ticket',
                'read_only' => true,
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('Sujet', 'text', array(
                'label' => 'Sujet',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                ),
                'read_only' => true
            ))
            ->add('Description', 'textarea', array(
                'label' => 'Description',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'rows' => '5',
                ),
                'read_only' => true
            ))
            ->add('Satisfaction', 'choice', array(
                'label' => 'Satisfaction',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $this->choices_10,
                'expanded' => true,
                'multiple' => false,
                'read_only' => true,
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('Conformite', 'choice', array(
                'label' => 'Conformité',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $this->choices_10,
                'expanded' => true,
                'multiple' => false,
                'read_only' => true,
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('Accompagnement', 'choice', array(
                'label' => 'Accompagnement',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $this->choices_10,
                'expanded' => true,
                'multiple' => false,
                'read_only' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'disabled'=> true,
                )
            ))
            ->add('Delais', 'choice', array(
                'label' => 'Délais',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $this->choices_10,
                'expanded' => true,
                'multiple' => false,
                'read_only' => true,
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('Commentaires', 'textarea', array(
                'label' => 'Commentaires',
                'read_only' => true,
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('numticket', 'hidden', array(
                'label' => 'numticket',
            ))
            ->add('id', 'hidden', array(
                'label' => 'id',
            ))
            ->add('Modifier', 'submit', array(
                'label' => 'Modifier',
                'attr' => array(
                    'class' => 'btn btn-warning',
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
