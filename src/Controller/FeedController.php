<?php
namespace App\Controller;

use App\Entity\Feed;
use App\Form\Type\FeedType;
use App\Repository\FeedRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
        $feeds = $feedRepo->findBy(['state' => Feed::STATE_VISIBLE]);

        // Present in a random order to not prioritize a channel
        shuffle($feeds);

        return $this->render('base.html.twig', [
            'title' => 'Daily Trends',
            'items' => $feeds
        ]);
    }

    /**
     * @Route("/{id}/edit", name="feed_edit")
     */
    public function feedEdit(Request $request, Feed $feed)
    {
        $feedForm = $this->createForm(FeedType::class, $feed);

        $message = '';

        $feedForm ->handleRequest($request);
        if ($feedForm->isValid()) {
            if ($request->getMethod() == 'POST') {
                /** @var ObjectManager $objectManager */
                $objectManager = $this->get('doctrine.orm.default_entity_manager');
                $objectManager->flush();
                $message = 'Feed guardado correctamente';
            }
        }

        return $this->render('form/feed.edit.html.twig', array(
            'form' => $feedForm->createView(),
            'message' => $message
        ));
    }
}