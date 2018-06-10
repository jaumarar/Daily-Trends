<?php

namespace App\UseCase;

use App\Entity\Channel;
use App\Factory\ChannelFactory;
use Doctrine\Common\Persistence\ObjectManager;

class ChannelAddUseCase
{

    const SERVICE = 'daily-trends:channel_add_use_case';

    protected $objectManager;

    protected $channelFactory;

    public function __construct(ObjectManager $objectManager, ChannelFactory $channelFactory)
    {
        $this->objectManager = $objectManager;
        $this->channelFactory = $channelFactory;
    }


    public function execute($name, $url)
    {
        $channel = $this->channelFactory->create($name, $url);

        $channel->setAccessState(Channel::ACCESS_AVAILABLE);
        $channel->setPullState(Channel::PULL_ENABLED);

        $this->objectManager->flush();

        return $channel;
    }
}