<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:03 PM
 */

namespace Viettut\Form\Type;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Viettut\Entity\Core\Tag;
use Viettut\Entity\Core\TutorialTag;

class TutorialTagFormType extends AbstractRoleSpecificFormType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tag', 'entity', array(
                    'class' => Tag::class
                )
            )
        ;

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function(FormEvent $event){
                $form = $event->getForm();
                $tag = $event->getData();
                if (is_array($tag['tag'])) {
                    $form->remove('tag');
                    $form->add('tag', new TagFormType());
                }
            });
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => TutorialTag::class,
                'cascade_validation' => true,
            ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'viettut_form_tutorial_tag';
    }
}