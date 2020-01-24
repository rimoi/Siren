<?php

namespace App\Command;

use App\Entity\Sirene;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateSireneCommand extends Command
{
    protected static $defaultName = 'app:update-sirene';
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(string $name = null, EntityManagerInterface $entityManager)
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setDescription('Command to update the SIRENE database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /*
         * NB: Pour la mise à jour il suffit de mettre un cron qui s'exécutera tous les jours  et qui mettra à jour les données
         *  et n'oubliez de changer le path ( dans la fonction 'createFromPath') pour renseigner le lien du fichier CSV
         */

        try {
            $reader = Reader::createFromPath(dirname(__DIR__).'/Data/Sirene.csv');
            $results = $reader->fetchAssoc();
            foreach ($results as $row) {
                $sirene = (new Sirene())
                    ->setSiren($row['SIREN'])
                    ->setNic($row['NIC'])
                    ->setOrganization($row['ENSEIGNE'])
                ;

                $this->entityManager->persist($sirene);
            }

            $this->entityManager->flush();
        } Catch (\Exception $e) {
            // J'envoie un message au (slack, ...) pour informé que la mise à jour a échoué.
        }


        return 0;
    }
}
