<?php
declare(strict_types=1);
namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Choice;
class SearchForm extends AbstractType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class,
            [
                'attr' => ['name' => 'title']
            ])
            ->add('api', ChoiceType::class,
            [
                'choices' => [
                    'tmdb' => 'tmdb'
                ]
            ])
            ->add('Submit', SubmitType::class, ['label' => 'Поиск']);
    }
}