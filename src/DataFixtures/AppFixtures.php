<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {

        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new Admin();
        $user->setUsername('bogdan');
        $user->setPassword($this->passwordEncoder->encodePassword($user,"secret"));
        $manager->persist($user);

        for ($i=0;$i<20;$i++) {
            $p = new Project();
            $p->setTitle("Project n° $i")
               ->setDescription("sskjsdkfdsfs dfdsfsdf sd sd  fsdfsdf")
                ->setIntroduction("qskdjsd,f sdfd sd qs dskdsd")
                ->setImage('http://image.js')
                ->setUrl("http://sb.scanteie.eu");
            $manager->persist($p);

        }
        $manager->flush();
    }
}
