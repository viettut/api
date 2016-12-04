<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:00 PM
 */

namespace Viettut\Form\Type;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Viettut\Entity\Core\Course;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\Core\CourseTagInterface;
use Viettut\Utilities\StringFactory;

class CourseFormType extends AbstractRoleSpecificFormType
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
            ->add('introduce')
            ->add('imagePath')
            ->add('courseTags', 'collection', array(
                'mapped' => true,
                'allow_add' => true,
                'allow_delete' => true,
                'type' => new CourseTagFormType()
            ))
        ;

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                /** @var CourseInterface $course */
                $course = $event->getData();
                if($course->getId() === null){
                    $course->setView(0);
                    $course->setEnroll(0);
                    $course->setActive(false);
                    $course->setToken(uniqid("", true));
                    $course->setHashTag($this->getUrlFriendlyString($course->getTitle()));
                }

                $courseTags = $course->getCourseTags();

                /** @var CourseTagInterface $courseTag */
                foreach($courseTags as $courseTag) {
                    $courseTag->setCourse($course);
                }
            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Course::class
            ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'viettut_form_course';
    }
}