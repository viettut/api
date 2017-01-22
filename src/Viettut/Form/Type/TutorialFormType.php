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
use Viettut\Entity\Core\Tutorial;
use Viettut\Model\Core\ChapterInterface;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\Core\TutorialInterface;
use Viettut\Model\Core\TutorialTagInterface;
use Viettut\Utilities\StringFactory;

class TutorialFormType extends AbstractRoleSpecificFormType
{
    use StringFactory;
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('published')
            ->add('tutorialTags', 'collection', array(
                'mapped' => true,
                'allow_add' => true,
                'allow_delete' => true,
                'type' => new TutorialTagFormType()
            ))
        ;

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) {
                /**
                 * @var TutorialInterface $tutorial
                 */
                $tutorial = $event->getData();

                if ($tutorial->getId() === null) {
                    $tutorial->setActive(true);
                    $tutorial->setLikes(0);
                    $tutorial->setView(0);
                }
                $tutorial->setHashTag($this->getUrlFriendlyString($tutorial->getTitle()));

                $tutorialTags = $tutorial->getTutorialTags();

                /** @var TutorialTagInterface $tutorialTag */
                foreach($tutorialTags as $tutorialTag) {
                    $tutorialTag->setTutorial($tutorial);
                }

                if ($tutorial->isPublished() === null) {
                    $tutorial->setPublished(false);
                }
            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Tutorial::class,
                'cascade_validation' => true,
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
        return 'viettut_form_tutorial';
    }
}