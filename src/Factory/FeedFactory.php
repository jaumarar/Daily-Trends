<?php
namespace App\Factory;

use App\Entity\Channel;
use App\Entity\Feed;
use Doctrine\Common\Persistence\ObjectManager;

class FeedFactory
{

    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function create(Channel $channel)
    {
        $feed = $this->build($channel);
        $this->objectManager->persist($feed);
        return $feed;
    }

    public function build(Channel $channel)
    {
        return new Feed($channel);
    }
}