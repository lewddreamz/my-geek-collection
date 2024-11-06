<?php
namespace App\Forms;
use App\Enums\CollectionTypes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
class CollectionForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name', TextType::class)
                ->add('type', ChoiceType::class, [
                    'choices' => [
                        'Film' => CollectionTypes::Film,
                        'Game' => CollectionTypes::Game,
                        'Book' => CollectionTypes::Book
                    ]
                ])
                ->add('submit', SubmitType::class);
    }
}