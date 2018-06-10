<?php
namespace App\Command;

use App\UseCase\ChannelAddUseCase;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChannelAddCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('daily-trends:channel-add')
            ->setDescription('Add a channel')

            ->addArgument('name', InputArgument::REQUIRED, 'Name of the RSS')
            ->addArgument('url', InputArgument::REQUIRED, 'Url associated');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ChannelAddUseCase $channelAddUseCase */
        $channelAddUseCase = $this->getContainer()->get(ChannelAddUseCase::SERVICE);
        $channel = $channelAddUseCase->execute(
            $input->getArgument('name'),
            $input->getArgument('url')
        );

        $output->writeln(json_encode(['id' => $channel->getId(), 'name' => $channel->getName()], JSON_PRETTY_PRINT));
    }
}