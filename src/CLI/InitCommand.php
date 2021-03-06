<?php

namespace Couscous\CLI;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Initialize the directory for Couscous.
 *
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 */
class InitCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('init')
            ->setDescription('Initialize the directory for Couscous');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (! file_exists(getcwd() . '/couscous.yml')) {
            $output->writeln('<comment>Creating a new default couscous.yml file.</comment>');
            touch(getcwd() . '/couscous.yml');
        }

        if (! file_exists(getcwd() . '/website')) {
            $output->writeln('<comment>Creating a new default website/ directory.</comment>');
            mkdir(getcwd() . '/website');
        }

        if (! file_exists(getcwd() . '/website/page.twig')) {
            $output->writeln('<comment>Importing the default template.</comment>');
            $template = <<<HTML
<!DOCTYPE html>
<html>
    <head>
        <title>Documentation</title>
    </head>
    <body>
        {{ content|raw }}
    </body>
</html>
HTML;
            file_put_contents(getcwd() . '/website/page.twig', $template);
            mkdir(getcwd() . '/website/public');
        }

        if (! file_exists(getcwd() . '/README.md')) {
            $output->writeln('<comment>Creating a new default README.md file.</comment>');
            $readme = <<<HTML
Welcome!
HTML;
            file_put_contents(getcwd() . '/README.md', $readme);
        }

        $output->writeln('<comment>The current directory is ready to work with Couscous.</comment>');
    }
}
