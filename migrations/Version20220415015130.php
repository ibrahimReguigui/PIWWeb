<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415015130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_cour_salle ADD id_cour_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation_cour_salle ADD CONSTRAINT FK_D0003D5169098673 FOREIGN KEY (id_cour_id) REFERENCES cour_salle (id)');
        $this->addSql('CREATE INDEX IDX_D0003D5169098673 ON reservation_cour_salle (id_cour_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_cour_salle DROP FOREIGN KEY FK_D0003D5169098673');
        $this->addSql('DROP INDEX IDX_D0003D5169098673 ON reservation_cour_salle');
        $this->addSql('ALTER TABLE reservation_cour_salle DROP id_cour_id');
    }
}
