<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408003849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, id_salle_id INT NOT NULL, id_sportif_id INT NOT NULL, d_debut DATE NOT NULL, d_fin DATE NOT NULL, INDEX IDX_351268BB8CEBACA0 (id_salle_id), INDEX IDX_351268BB5A3D88EC (id_sportif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB8CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB5A3D88EC FOREIGN KEY (id_sportif_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE abonnement');
    }
}
