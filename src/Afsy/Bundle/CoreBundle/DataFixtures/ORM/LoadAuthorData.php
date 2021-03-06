<?php

namespace Afsy\Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Afsy\Bundle\CoreBundle\Entity\Author;

class LoadAuthorData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new Author();
        $user->setName('Xavier Lacot');
        $user->setEmail('xavier@lacot.org');
        $user->setCity('Paris');
        $user->setIsEnabled(true);
        $manager->persist($user);
        $this->addReference('xavierlacot', $user);
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
