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
use Viettut\Model\Core\TagInterface;

class TagFormType extends AbstractRoleSpecificFormType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text')
            ->add('icon')
        ;

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) {
                /** @var TagInterface $tag */
                $tag = $event->getData();
                if ($tag->getId() === null) {
                    $tag->setCount(0);
                }
            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Tag::class
            ]);
    }
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'viettut_form_tag';
    }
}