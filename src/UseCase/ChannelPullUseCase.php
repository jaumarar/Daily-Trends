<?php
namespace App\UseCase;

use App\Entity\Channel;
use App\Entity\Feed;
use App\Factory\FeedFactory;
use App\Repository\ChannelRepository;
use Doctrine\Common\Persistence\ObjectManager;
use FeedIo\Feed\Item;
use FeedIo\Feed\Item\Media;
use FeedIo\FeedInterface;
use FeedIo\FeedIo;

class ChannelPullUseCase
{

    const SERVICE = 'daily-trends:channel_pull_use_case';

    protected $objectManager;

    protected $feedFactory;


    public function __construct(ObjectManager $objectManager, FeedFactory $feedFactory)
    {
        $this->objectManager = $objectManager;
        $this->feedFactory = $feedFactory;
    }

    public function execute(FeedIo $feedIo)
    {
        /** @var ChannelRepository $channelRepository */
        $channelRepository = $this->objectManager->getRepository(Channel::class);
        $channels = $channelRepository->findAll();

        /** @var Channel $channel */
        foreach ($channels as $channel){
            if($channel->getPullState() !== Channel::PULL_ENABLED){
                continue;
            }
            if($channel->getLastPullDate() instanceof \DateTime){
                $lastPull = $channel->getLastPullDate();
            } else {
                $lastPull = (new \DateTime())->sub(new \DateInterval('P1M'));
            }

            $feed = $feedIo->readSince($channel->getUrl(), $lastPull)->getFeed();
            /** @var Item $item */
            foreach ( $feed as $item ) {
                $f = $this->feedFactory->create($channel);

                $f->setTitle( $item->getTitle() );
                $f->setDescription( $item->getDescription() );
                $f->setUrl( $item->getLink() );
                /** @var Media $media */
                foreach ($item->getMedias() as $media) {
                    $f->setImageUrl( $media->getUrl() );
                    break;
                }
                $f->setState(Feed::STATE_VISIBLE);
            }

            $channel->setLastPullDate(new \DateTime());

            $this->objectManager->flush();
        }

    }

}