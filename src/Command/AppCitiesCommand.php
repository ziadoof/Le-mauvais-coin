<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 21/07/18
 * Time: 21:35
 */

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\Entity\Region;
use App\Entity\Department;
use App\Entity\City;
use Doctrine\ORM\EntityManager;


class AppCitiesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:cities')
            ->setDescription('Importer les villes de france depuis un CSV')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /* @var $em EntityManager */
        $em = $this->getContainer()->get('doctrine')->getManager();

        // yolo
        ini_set("memory_limit", "-1");

        // On vide les 3 tables
        $connection = $em->getConnection();
        $platform   = $connection->getDatabasePlatform();
        $connection->executeUpdate($platform->getTruncateTableSQL('city', true /* whether to cascade */));
        $connection->executeUpdate($platform->getTruncateTableSQL('region', true /* whether to cascade */));
        $connection->executeUpdate($platform->getTruncateTableSQL('department', true /* whether to cascade */));

        $csv = dirname($this->getContainer()->get('kernel')->getRootDir()) . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . '\Command';
        $lines = explode("\n", file_get_contents($csv));
        $regions = [];
        $departments = [];
        $city = [];

        foreach ($lines as $k => $line) {
            $line = explode(';', $line);
            if (count($line) > 10 && $k > 0) {
                // On sauvegarde la region
                if (!key_exists($line[1], $regions)) {
                    $region = new Region();
                    $region->setName($line[2]);
                    $regions[$line[1]] = $region;
                    $em->persist($region);
                } else {
                    $region = $regions[$line[1]];
                }

                // On sauvegarde le departement
                if (!key_exists($line[4], $departments)) {
                    $departement = new Department();
                    $departement->setName($line[5]);
                    $departement->setShortCode($line[4]);
                    $departement->setRegion($region);
                    $departments[$line[4]] = $departement;
                    $em->persist($departement);
                } else {
                    $department = $departments[$line[4]];
                }

                // On sauvegarde la ville
                $ville = new City();
                $ville->setName($line[8]);
                $ville->setPostalCode($line[9]);
                $ville->setDepartment($department);
                $villes[] = $line[8];
                $em->persist($ville);
            }
        }
        $em->flush();
        $output->writeln(count($villes) . ' villes importées');
    }

}