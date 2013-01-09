<?php

namespace Afsy\Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Afsy\Bundle\CoreBundle\Entity\Article;

class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{
    protected $articles = array(
        array(
            'title' => 'Introduction au composant Config',
            'body' => '<p>
                    <strong>Mercredi 9 mai 2012</strong>, <strong>de 19h à 20h</strong>, la société <a href="http://www.theodo.fr/">Theodo</a> accueille <strong>Christophe Coevet</strong> (<a href="https://twitter.com/#!/Stof70">Stof70</a>) qui présentera une introduction au composant autonome &laquo; Config &raquo; de Symfony. Cette conférence mettra en avant l\'utilité de ce composant et sa mise en oeuvre pratique au sein des bundles. Christophe mettra aussi l\'accent sur l\'utilisation de ce composant en dehors du contexte de Symfony. La soirée se terminera par un pot général au pub <strong>The Lions</strong>.
                </p>
                <p>
                    <address>
                        Pub The Lions<br>
                        120 rue Montmartre<br>
                        75002 Paris
                    </address>
                </p>',
            'city' => 'Paris',
            'tags' => array('Config', 'Paris', 'config'),
            'published_at' => '2012-05-09',
            'map' => '<img src="http://maps.google.com/maps/api/staticmap?center=48.867804,2.343843&amp;zoom=16&amp;markers=size:mid|color:green|120+rue+Montmartre,+Paris&amp;path=color:0x0000FFff|weight:10|48.88435,2.40034&amp;size=470x260&amp;sensor=true" alt="" />'
        )
    );
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->articles as $article) {
            $entity = new Article();
            $entity->setBody($article['body']);
            $entity->setCity($article['city']);
            $entity->setIsPublished(true);
            $entity->setMap($article['map']);
            $entity->setMarkdownBody('html content loaded, please do not edit this post');
            $entity->setPublishedAt(new \DateTime($article['published_at']));
            $entity->setTags($article['tags']);
            $entity->setTitle($article['title']);
            $entity->addAuthor($this->getReference('xavierlacot'));
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}