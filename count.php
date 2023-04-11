#!/usr/bin/env php

<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\SingleCommandApplication;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

(new SingleCommandApplication())
    ->setDescription('Count the sum of values in "count" files in all subdirectories of directories list')
    ->addArgument('paths', InputArgument::IS_ARRAY | InputArgument::REQUIRED, "A path or a list of paths to the directories, separated by spaces")
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        $paths = $input->getArgument("paths");
        $finder = new Finder();
        $finder->files()->in($paths)->name("count");
        $sum = 0;
        foreach ($finder as $file) $sum += intval($file->getContents());
        $output->writeln($sum);
    })->run();

?>