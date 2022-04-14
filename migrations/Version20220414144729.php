<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220414144729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caracteristiquesportif DROP FOREIGN KEY FK_3C1699E45A3D88EC');
        $this->addSql('DROP INDEX UNIQ_3C1699E45A3D88EC ON caracteristiquesportif');
        $this->addSql('ALTER TABLE caracteristiquesportif CHANGE id_sportif id_sportif_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE caracteristiquesportif ADD CONSTRAINT FK_3C1699E45A3D88EC FOREIGN KEY (id_sportif_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3C1699E45A3D88EC ON caracteristiquesportif (id_sportif_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caracteristiquesportif DROP FOREIGN KEY FK_3C1699E45A3D88EC');
        $this->addSql('DROP INDEX UNIQ_3C1699E45A3D88EC ON caracteristiquesportif');
        $this->addSql('ALTER TABLE caracteristiquesportif CHANGE id_sportif_id id_sportif INT DEFAULT NULL');
        $this->addSql('ALTER TABLE caracteristiquesportif ADD CONSTRAINT FK_3C1699E45A3D88EC FOREIGN KEY (id_sportif) REFERENCES utilisateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3C1699E45A3D88EC ON caracteristiquesportif (id_sportif)');
    }
}
