<?php
namespace App\Controller;

use App\Entity\Feed;
use App\Repository\FeedRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class FeedController extends Controller
{
    /**
     * @Route("/")
     */
    public function homepageAction()
    {
        /** @var ObjectManager $objectManager */
        $objectManager = $this->get('doctrine.orm.default_entity_manager');
        /** @var FeedRepository $feedRepo */
        $feedRepo = $objectManager->getRepository(Feed::class);
        /** @var Feed[] $feeds */
        $feeds = $feedRepo->findAll();

        // Present in a random order to not prioritize a channel
        shuffle($feeds);

        return $this->render('base.html.twig', [
            'title' => 'sdasdasd',
            'items' => $feeds
        ]);
    }
}