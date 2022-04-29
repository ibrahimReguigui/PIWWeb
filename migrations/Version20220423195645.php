<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220423195645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercice (id INT AUTO_INCREMENT NOT NULL, nom_exercice VARCHAR(100) NOT NULL, description_exercice VARCHAR(200) NOT NULL, categorie_exercice VARCHAR(200) NOT NULL, nbr_repetition INT NOT NULL, nbr_serie INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme (id INT AUTO_INCREMENT NOT NULL, exercices_id INT DEFAULT NULL, nom_programme VARCHAR(100) DEFAULT NULL, objectif_programme VARCHAR(100) NOT NULL, description_programme VARCHAR(255) NOT NULL, categorie_programme VARCHAR(100) NOT NULL, INDEX IDX_3DDCB9FF192C7251 (exercices_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF192C7251 FOREIGN KEY (exercices_id) REFERENCES exercice (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FF192C7251');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE programme');
    }
}
