<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:03 PM
 */

namespace Viettut\Form\Type;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Viettut\Entity\Core\Chapter;
use Viettut\Model\Core\ChapterInterface;
use Viettut\Model\Core\CourseInterface;
use Viettut\Utilities\StringFactory;

class ChapterFormType extends AbstractRoleSpecificFormType
{
    use StringFactory;
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('header')
            ->add('content')
            ->add('course')
        ;

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                /** @var ChapterInterface $chapter */
                $chapter = $event->getData();

                /** @var CourseInterface $course */
                $course = $chapter->getCourse();

                if(!$course instanceof CourseInterface) {
                    $event->getForm()->get('course')->addError(new FormError('course can not be blank'));
                    return;
                }
                else {
                    $course->getChapters()->add($chapter);
                }

                if($chapter->getId() === null){
                    $chapter->setActive(true);
                    $chapter->setHashTag($this->getUrlFriendlyString($chapter->getHeader()));
                    $chapter->setPosition(count($course->getChapters()));
                    $chapter->setToken(uniqid('', true));
                }
            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Chapter::class,
                'csrf_protection'   => false
            ]);
    }
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'viettut_form_chapter';
    }
}