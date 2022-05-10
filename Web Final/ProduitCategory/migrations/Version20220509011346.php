<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509011346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonement ADD id_salle_id INT DEFAULT NULL, ADD id_sportif_id INT DEFAULT NULL, ADD d_debut DATE NOT NULL, ADD d_fin DATE NOT NULL');
        $this->addSql('ALTER TABLE abonement ADD CONSTRAINT FK_A4B598D8CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salles (id)');
        $this->addSql('ALTER TABLE abonement ADD CONSTRAINT FK_A4B598D5A3D88EC FOREIGN KEY (id_sportif_id) REFERENCES sportifs (id)');
        $this->addSql('CREATE INDEX IDX_A4B598D8CEBACA0 ON abonement (id_salle_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A4B598D5A3D88EC ON abonement (id_sportif_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonement DROP FOREIGN KEY FK_A4B598D8CEBACA0');
        $this->addSql('ALTER TABLE abonement DROP FOREIGN KEY FK_A4B598D5A3D88EC');
        $this->addSql('DROP INDEX IDX_A4B598D8CEBACA0 ON abonement');
        $this->addSql('DROP INDEX UNIQ_A4B598D5A3D88EC ON abonement');
        $this->addSql('ALTER TABLE abonement DROP id_salle_id, DROP id_sportif_id, DROP d_debut, DROP d_fin');
    }
}
