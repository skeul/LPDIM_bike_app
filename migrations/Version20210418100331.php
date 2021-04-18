<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210418100331 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parcours (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, distance DOUBLE PRECISION NOT NULL, difficulte INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE sommet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, altitude INTEGER NOT NULL, lieu VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE sortie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_sortie DATETIME NOT NULL, status INTEGER NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE parcours');
        $this->addSql('DROP TABLE sommet');
        $this->addSql('DROP TABLE sortie');
    }
}
