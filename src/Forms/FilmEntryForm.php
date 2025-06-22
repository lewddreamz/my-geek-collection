<?php
declare(strict_types=1);
namespace App\Forms;

use App\Entity\FilmEntry;
use App\Forms\EntryForm;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class FilmEntryForm extends EntryForm
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('film', FilmForm::class);
    }
    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FilmEntry::class
        ]);
    }
}