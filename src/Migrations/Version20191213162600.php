<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213162600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE oeuvre_genre (oeuvre_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_1C18708788194DE8 (oeuvre_id), INDEX IDX_1C1870874296D31F (genre_id), PRIMARY KEY(oeuvre_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nationalite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, nb_episodes INT NOT NULL, nb_saisons INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oeuvre_genre ADD CONSTRAINT FK_1C18708788194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre_genre ADD CONSTRAINT FK_1C1870874296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre ADD nationalite_id INT DEFAULT NULL, ADD resume LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFE1B063272 FOREIGN KEY (nationalite_id) REFERENCES nationalite (id)');
        $this->addSql('CREATE INDEX IDX_35FE2EFE1B063272 ON oeuvre (nationalite_id)');
        $this->addSql('ALTER TABLE film ADD duree VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE personnalite ADD nationalite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnalite ADD CONSTRAINT FK_411DF31D1B063272 FOREIGN KEY (nationalite_id) REFERENCES nationalite (id)');
        $this->addSql('CREATE INDEX IDX_411DF31D1B063272 ON personnalite (nationalite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFE1B063272');
        $this->addSql('ALTER TABLE personnalite DROP FOREIGN KEY FK_411DF31D1B063272');
        $this->addSql('ALTER TABLE oeuvre_genre DROP FOREIGN KEY FK_1C1870874296D31F');
        $this->addSql('DROP TABLE oeuvre_genre');
        $this->addSql('DROP TABLE nationalite');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE serie');
        $this->addSql('ALTER TABLE film DROP duree');
        $this->addSql('DROP INDEX IDX_35FE2EFE1B063272 ON oeuvre');
        $this->addSql('ALTER TABLE oeuvre DROP nationalite_id, DROP resume');
        $this->addSql('DROP INDEX IDX_411DF31D1B063272 ON personnalite');
        $this->addSql('ALTER TABLE personnalite DROP nationalite_id');
    }
}
