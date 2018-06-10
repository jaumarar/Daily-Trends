<?php
namespace App\Command;

use App\UseCase\ChannelPullUseCase;
use FeedIo\FeedIo;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChannelPullCommand extends ContainerAwareCommand
{

    const SERVICE = 'daily-trends:channel-pull';

    protected function configure()
    {
        $this
            ->setName(static::SERVICE)
            ->setDescription('Updates all the channels enabled');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ChannelPullUseCase $srv */
        $srv = $this->getContainer()->get(ChannelPullUseCase::SERVICE);
        /** @var FeedIo $feedIo */
        $feedIo = $this->getContainer()->get('feedio');
        $srv->execute($feedIo);
    }
}