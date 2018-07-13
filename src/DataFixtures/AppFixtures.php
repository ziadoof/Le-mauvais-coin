<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 12/07/18
 * Time: 17:46
 */

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [$username,$firstname, $lastname,  $password, $email, $roles, $photo, $telephone]) {
            $user = new User();
            $user->setUsername($username);
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $user->setEmail($email);
            $user->setRoles($roles);
            $user->setPhoto($photo);
            $user->setTelephone($telephone);

            $manager->persist($user);
            $this->addReference($username, $user);
        }

        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            // $userData = [$firstname, $lastname, $username, $password, $email, $roles,telephone, $photo];
            ['Admin', 'Jane', 'naji', '1234', 'jane_admin@symfony.com', ['ROLE_ADMIN'], 'http//:', 12345678],
            ['admin2', 'Tom', ' jdaydani',  '1234', 'tom_admin@symfony.com', ['ROLE_ADMIN'], 'http//:',12345678],
            ['user','ziad ', 'ibrahim',  '1234', 'john_user@symfony.com', ['ROLE_USER'], 'http//:',12345678] ,
            ['user2','reem ', ' fadel',  '1234', 'ana_user@symfony.com', ['ROLE_USER'], 'http//:',12345678]
        ];
    }
}