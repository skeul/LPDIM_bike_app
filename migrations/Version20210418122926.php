<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210418122926 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parcours_sommet (parcours_id INTEGER NOT NULL, sommet_id INTEGER NOT NULL, PRIMARY KEY(parcours_id, sommet_id))');
        $this->addSql('CREATE INDEX IDX_EF17CAE66E38C0DB ON parcours_sommet (parcours_id)');
        $this->addSql('CREATE INDEX IDX_EF17CAE65468BBDC ON parcours_sommet (sommet_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__electric AS SELECT id, puissance, autonomie FROM electric');
        $this->addSql('DROP TABLE electric');
        $this->addSql('CREATE TABLE electric (id INTEGER NOT NULL, puissance INTEGER NOT NULL, autonomie DOUBLE PRECISION NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_E438AFAABF396750 FOREIGN KEY (id) REFERENCES velo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO electric (id, puissance, autonomie) SELECT id, puissance, autonomie FROM __temp__electric');
        $this->addSql('DROP TABLE __temp__electric');
        $this->addSql('CREATE TEMPORARY TABLE __temp__route AS SELECT id FROM route');
        $this->addSql('DROP TABLE route');
        $this->addSql('CREATE TABLE route (id INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_2C42079BF396750 FOREIGN KEY (id) REFERENCES velo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO route (id) SELECT id FROM __temp__route');
        $this->addSql('DROP TABLE __temp__route');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sortie AS SELECT id, date_sortie, status FROM sortie');
        $this->addSql('DROP TABLE sortie');
        $this->addSql('CREATE TABLE sortie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, parcours_id INTEGER NOT NULL, date_sortie DATETIME NOT NULL, status INTEGER NOT NULL, CONSTRAINT FK_3C3FD3F26E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sortie (id, date_sortie, status) SELECT id, date_sortie, status FROM __temp__sortie');
        $this->addSql('DROP TABLE __temp__sortie');
        $this->addSql('CREATE INDEX IDX_3C3FD3F26E38C0DB ON sortie (parcours_id)');
        $this->addSql('DROP INDEX IDX_F7129A803AD8644E');
        $this->addSql('DROP INDEX IDX_F7129A80233D34C1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_user AS SELECT user_source, user_target FROM user_user');
        $this->addSql('DROP TABLE user_user');
        $this->addSql('CREATE TABLE user_user (user_source INTEGER NOT NULL, user_target INTEGER NOT NULL, PRIMARY KEY(user_source, user_target), CONSTRAINT FK_F7129A803AD8644E FOREIGN KEY (user_source) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F7129A80233D34C1 FOREIGN KEY (user_target) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_user (user_source, user_target) SELECT user_source, user_target FROM __temp__user_user');
        $this->addSql('DROP TABLE __temp__user_user');
        $this->addSql('CREATE INDEX IDX_F7129A803AD8644E ON user_user (user_source)');
        $this->addSql('CREATE INDEX IDX_F7129A80233D34C1 ON user_user (user_target)');
        $this->addSql('DROP INDEX IDX_354971F5A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__velo AS SELECT id, user_id, marque, modele, poids, image, type FROM velo');
        $this->addSql('DROP TABLE velo');
        $this->addSql('CREATE TABLE velo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, marque VARCHAR(255) NOT NULL COLLATE BINARY, modele VARCHAR(255) NOT NULL COLLATE BINARY, poids DOUBLE PRECISION NOT NULL, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, type VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_354971F5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO velo (id, user_id, marque, modele, poids, image, type) SELECT id, user_id, marque, modele, poids, image, type FROM __temp__velo');
        $this->addSql('DROP TABLE __temp__velo');
        $this->addSql('CREATE INDEX IDX_354971F5A76ED395 ON velo (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__vtt AS SELECT id, suspension_avant, suspension_arriere FROM vtt');
        $this->addSql('DROP TABLE vtt');
        $this->addSql('CREATE TABLE vtt (id INTEGER NOT NULL, suspension_avant INTEGER NOT NULL, suspension_arriere INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_B306C427BF396750 FOREIGN KEY (id) REFERENCES velo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO vtt (id, suspension_avant, suspension_arriere) SELECT id, suspension_avant, suspension_arriere FROM __temp__vtt');
        $this->addSql('DROP TABLE __temp__vtt');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE parcours_sommet');
        $this->addSql('CREATE TEMPORARY TABLE __temp__electric AS SELECT id, puissance, autonomie FROM electric');
        $this->addSql('DROP TABLE electric');
        $this->addSql('CREATE TABLE electric (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, puissance INTEGER NOT NULL, autonomie DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO electric (id, puissance, autonomie) SELECT id, puissance, autonomie FROM __temp__electric');
        $this->addSql('DROP TABLE __temp__electric');
        $this->addSql('CREATE TEMPORARY TABLE __temp__route AS SELECT id FROM route');
        $this->addSql('DROP TABLE route');
        $this->addSql('CREATE TABLE route (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('INSERT INTO route (id) SELECT id FROM __temp__route');
        $this->addSql('DROP TABLE __temp__route');
        $this->addSql('DROP INDEX IDX_3C3FD3F26E38C0DB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sortie AS SELECT id, date_sortie, status FROM sortie');
        $this->addSql('DROP TABLE sortie');
        $this->addSql('CREATE TABLE sortie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_sortie DATETIME NOT NULL, status INTEGER NOT NULL)');
        $this->addSql('INSERT INTO sortie (id, date_sortie, status) SELECT id, date_sortie, status FROM __temp__sortie');
        $this->addSql('DROP TABLE __temp__sortie');
        $this->addSql('DROP INDEX IDX_F7129A803AD8644E');
        $this->addSql('DROP INDEX IDX_F7129A80233D34C1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_user AS SELECT user_source, user_target FROM user_user');
        $this->addSql('DROP TABLE user_user');
        $this->addSql('CREATE TABLE user_user (user_source INTEGER NOT NULL, user_target INTEGER NOT NULL, PRIMARY KEY(user_source, user_target))');
        $this->addSql('INSERT INTO user_user (user_source, user_target) SELECT user_source, user_target FROM __temp__user_user');
        $this->addSql('DROP TABLE __temp__user_user');
        $this->addSql('CREATE INDEX IDX_F7129A803AD8644E ON user_user (user_source)');
        $this->addSql('CREATE INDEX IDX_F7129A80233D34C1 ON user_user (user_target)');
        $this->addSql('DROP INDEX IDX_354971F5A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__velo AS SELECT id, user_id, marque, modele, poids, image, type FROM velo');
        $this->addSql('DROP TABLE velo');
        $this->addSql('CREATE TABLE velo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, marque VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, poids DOUBLE PRECISION NOT NULL, image VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO velo (id, user_id, marque, modele, poids, image, type) SELECT id, user_id, marque, modele, poids, image, type FROM __temp__velo');
        $this->addSql('DROP TABLE __temp__velo');
        $this->addSql('CREATE INDEX IDX_354971F5A76ED395 ON velo (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__vtt AS SELECT id, suspension_avant, suspension_arriere FROM vtt');
        $this->addSql('DROP TABLE vtt');
        $this->addSql('CREATE TABLE vtt (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, suspension_avant INTEGER NOT NULL, suspension_arriere INTEGER NOT NULL)');
        $this->addSql('INSERT INTO vtt (id, suspension_avant, suspension_arriere) SELECT id, suspension_avant, suspension_arriere FROM __temp__vtt');
        $this->addSql('DROP TABLE __temp__vtt');
    }
}
