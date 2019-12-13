<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213162257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE oeuvre (id INT AUTO_INCREMENT NOT NULL, nationalite_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, resume LONGTEXT NOT NULL, INDEX IDX_35FE2EFE1B063272 (nationalite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oeuvre_genre (oeuvre_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_1C18708788194DE8 (oeuvre_id), INDEX IDX_1C1870874296D31F (genre_id), PRIMARY KEY(oeuvre_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nationalite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier_personnalite (metier_id INT NOT NULL, personnalite_id INT NOT NULL, INDEX IDX_18925B88ED16FA20 (metier_id), INDEX IDX_18925B882E282BF5 (personnalite_id), PRIMARY KEY(metier_id, personnalite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, nb_episodes INT NOT NULL, nb_saisons INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, resume LONGTEXT NOT NULL, duree VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnalite (id INT AUTO_INCREMENT NOT NULL, nationalite_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, INDEX IDX_411DF31D1B063272 (nationalite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFE1B063272 FOREIGN KEY (nationalite_id) REFERENCES nationalite (id)');
        $this->addSql('ALTER TABLE oeuvre_genre ADD CONSTRAINT FK_1C18708788194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre_genre ADD CONSTRAINT FK_1C1870874296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_personnalite ADD CONSTRAINT FK_18925B88ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_personnalite ADD CONSTRAINT FK_18925B882E282BF5 FOREIGN KEY (personnalite_id) REFERENCES personnalite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnalite ADD CONSTRAINT FK_411DF31D1B063272 FOREIGN KEY (nationalite_id) REFERENCES nationalite (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE oeuvre_genre DROP FOREIGN KEY FK_1C18708788194DE8');
        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFE1B063272');
        $this->addSql('ALTER TABLE personnalite DROP FOREIGN KEY FK_411DF31D1B063272');
        $this->addSql('ALTER TABLE metier_personnalite DROP FOREIGN KEY FK_18925B88ED16FA20');
        $this->addSql('ALTER TABLE oeuvre_genre DROP FOREIGN KEY FK_1C1870874296D31F');
        $this->addSql('ALTER TABLE metier_personnalite DROP FOREIGN KEY FK_18925B882E282BF5');
        $this->addSql('DROP TABLE oeuvre');
        $this->addSql('DROP TABLE oeuvre_genre');
        $this->addSql('DROP TABLE nationalite');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE metier_personnalite');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE personnalite');
    }
}
