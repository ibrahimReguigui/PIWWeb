<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220414120951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE caracteristiquesportif (id INT AUTO_INCREMENT NOT NULL, id_sportif_id INT DEFAULT NULL, taille_sportif INT DEFAULT NULL, poid_sportif INT DEFAULT NULL, age_sportif INT DEFAULT NULL, sexe VARCHAR(255) DEFAULT NULL, objectif_nutrition VARCHAR(255) DEFAULT NULL, bmi_sportif DOUBLE PRECISION DEFAULT NULL, besoin_proteine DOUBLE PRECISION DEFAULT NULL, besoin_carb DOUBLE PRECISION DEFAULT NULL, besoin_calories DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_3C1699E45A3D88EC (id_sportif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE caracteristiquesportif ADD CONSTRAINT FK_3C1699E45A3D88EC FOREIGN KEY (id_sportif_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE caracteristiquesportif');
    }
}
