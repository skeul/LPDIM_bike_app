<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210418112509 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__electric AS SELECT id, puissance, autonomie FROM electric');
        $this->addSql('DROP TABLE electric');
        $this->addSql('CREATE TABLE electric (id INTEGER NOT NULL, puissance INTEGER NOT NULL, autonomie DOUBLE PRECISION NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_E438AFAABF396750 FOREIGN KEY (id) REFERENCES velo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO electric (id, puissance, autonomie) SELECT id, puissance, autonomie FROM __temp__electric');
        $this->addSql('DROP TABLE __temp__electric');
        $this->addSql('CREATE TEMPORARY TABLE __temp__vtt AS SELECT id, suspension_avant, suspension_arriere FROM vtt');
        $this->addSql('DROP TABLE vtt');
        $this->addSql('CREATE TABLE vtt (id INTEGER NOT NULL, suspension_avant INTEGER NOT NULL, suspension_arriere INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_B306C427BF396750 FOREIGN KEY (id) REFERENCES velo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO vtt (id, suspension_avant, suspension_arriere) SELECT id, suspension_avant, suspension_arriere FROM __temp__vtt');
        $this->addSql('DROP TABLE __temp__vtt');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__electric AS SELECT id, puissance, autonomie FROM electric');
        $this->addSql('DROP TABLE electric');
        $this->addSql('CREATE TABLE electric (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, puissance INTEGER NOT NULL, autonomie DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO electric (id, puissance, autonomie) SELECT id, puissance, autonomie FROM __temp__electric');
        $this->addSql('DROP TABLE __temp__electric');
        $this->addSql('CREATE TEMPORARY TABLE __temp__vtt AS SELECT id, suspension_avant, suspension_arriere FROM vtt');
        $this->addSql('DROP TABLE vtt');
        $this->addSql('CREATE TABLE vtt (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, suspension_avant INTEGER NOT NULL, suspension_arriere INTEGER NOT NULL)');
        $this->addSql('INSERT INTO vtt (id, suspension_avant, suspension_arriere) SELECT id, suspension_avant, suspension_arriere FROM __temp__vtt');
        $this->addSql('DROP TABLE __temp__vtt');
    }
}
