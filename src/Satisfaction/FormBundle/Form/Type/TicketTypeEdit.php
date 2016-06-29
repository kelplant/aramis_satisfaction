<?php

namespace Satisfaction\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Satisfaction\FormBundle\Entity\Ticket;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TicketTypeEdit extends AbstractType
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
            ->add('NumTicket', IntegerType::class, array(
                'label' => 'Numéro Ticket',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                ),
                'read_only' => true,
            ))
            ->add('Sujet', TextType::class, array(
                'label' => 'Sujet',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                ),
                'read_only' => true
            ))
            ->add('Description', TextareaType::class, array(
                'label' => 'Description',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'rows' => '5',
                ),
                'read_only' => true,
            ))
            ->add('Satisfaction', ChoiceType::class, array(
                'label' => 'Satisfaction',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $this->choices_10,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                ),
            ))
            ->add('Conformite', ChoiceType::class, array(
                'label' => 'Conformité',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $this->choices_10,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                ),
            ))
            ->add('Accompagnement', ChoiceType::class, array(
                'label' => 'Accompagnement',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $this->choices_10,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                ),
            ))
            ->add('Delais', ChoiceType::class, array(
                'label' => 'Délais',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'choices' => $this->choices_10,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                ),
            ))
            ->add('Commentaires', TextareaType::class, array(
                'label' => 'Commentaires',
                'label_attr' => array(
                    'class' => 'col-sm-2 control-label',
                ),
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                ),
            ))
            ->add('numticket', HiddenType::class, array(
                'label' => 'numticket'
            ))
            ->add('id', 'hidden', array(
                'label' => 'id'
            ))
            ->add('Envoyer', SubmitType::class, array(
                'label' => 'Envoyer',
                'attr' => array(
                    'class' => 'btn btn-success',
                ),
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
