<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407160802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cour_salle (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, nom_cour VARCHAR(255) NOT NULL, information VARCHAR(255) DEFAULT NULL, nbr_actuel INT NOT NULL, nbr_total INT NOT NULL, date DATE NOT NULL, time TIME NOT NULL, INDEX IDX_B0AAF4E5FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cour_salle ADD CONSTRAINT FK_B0AAF4E5FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cour_salle DROP FOREIGN KEY FK_B0AAF4E5FB88E14F');
        $this->addSql('DROP TABLE cour_salle');
        $this->addSql('DROP TABLE utilisateur');
    }
}
