<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210418105938 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE velo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, marque VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, poids DOUBLE PRECISION NOT NULL, image VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__electric AS SELECT id, puissance, autonomie FROM electric');
        $this->addSql('DROP TABLE electric');
        $this->addSql('CREATE TABLE electric (id INTEGER NOT NULL, puissance INTEGER NOT NULL, autonomie DOUBLE PRECISION NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_E438AFAABF396750 FOREIGN KEY (id) REFERENCES velo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO electric (id, puissance, autonomie) SELECT id, puissance, autonomie FROM __temp__electric');
        $this->addSql('DROP TABLE __temp__electric');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE velo');
        $this->addSql('CREATE TEMPORARY TABLE __temp__electric AS SELECT id, puissance, autonomie FROM electric');
        $this->addSql('DROP TABLE electric');
        $this->addSql('CREATE TABLE electric (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, puissance INTEGER NOT NULL, autonomie DOUBLE PRECISION NOT NULL, CONSTRAINT FK_E438AFAABF396750 FOREIGN KEY (id) REFERENCES velo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO electric (id, puissance, autonomie) SELECT id, puissance, autonomie FROM __temp__electric');
        $this->addSql('DROP TABLE __temp__electric');
    }
}
