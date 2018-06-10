<?php
namespace App\Factory;

use App\Entity\Channel;
use Doctrine\Common\Persistence\ObjectManager;

class ChannelFactory
{

    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function create($name, $url)
    {
        $channel = $this->build($name, $url);
        $this->objectManager->persist($channel);
        return $channel;
    }

    public function build($name, $url)
    {
        return new Channel($name, $url);
    }
}