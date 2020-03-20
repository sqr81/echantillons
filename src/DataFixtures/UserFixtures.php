<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setParaphe('SQR');
        $user->setUsername('sqr81');
        $user->setPassword($this->encoder->encodePassword($user, '1234'));
        $user->setUserRole('[\'ROLE_ADMIN\']');
        $user->setIsActif(true);
        $manager->persist($user);
        $manager->flush();
    }
}
