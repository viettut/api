<?php


namespace Viettut\Entity\Core;
use Viettut\Model\Core\UserChapter as UserChapterModel;

class UserChapter extends UserChapterModel
{
    protected $id;
    protected $course;
    protected $createdAt;
    protected $latestChapter;
    protected $updatedAt;
    protected $user;
}