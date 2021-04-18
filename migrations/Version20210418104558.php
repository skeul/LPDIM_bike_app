<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210418104558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE electric (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, puissance INTEGER NOT NULL, autonomie DOUBLE PRECISION NOT NULL)');
        $this->addSql('DROP TABLE velo');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE velo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, marque VARCHAR(255) NOT NULL COLLATE BINARY, modele VARCHAR(255) NOT NULL COLLATE BINARY, poids DOUBLE PRECISION NOT NULL, image VARCHAR(255) DEFAULT NULL COLLATE BINARY)');
        $this->addSql('DROP TABLE electric');
    }
}
