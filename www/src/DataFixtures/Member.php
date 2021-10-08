<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Member as MemberEntity;

class Member extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $member = new MemberEntity();
        $member->setname('Member 1');
        $manager->persist($member);

        $member = new MemberEntity();
        $member->setname('Member 2');
        $manager->persist($member);

        $member = new MemberEntity();
        $member->setname('Member 3');
        $manager->persist($member);

        $member = new MemberEntity();
        $member->setname('Member 4');
        $manager->persist($member);

        $manager->flush();
    }
}
