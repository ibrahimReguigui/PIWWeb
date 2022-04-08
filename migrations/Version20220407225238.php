<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407225238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_cour_salle (id INT AUTO_INCREMENT NOT NULL, id_salle_id INT NOT NULL, id_sportif_id INT NOT NULL, id_cour_id INT NOT NULL, INDEX IDX_D0003D518CEBACA0 (id_salle_id), INDEX IDX_D0003D515A3D88EC (id_sportif_id), INDEX IDX_D0003D5169098673 (id_cour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_cour_salle ADD CONSTRAINT FK_D0003D518CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reservation_cour_salle ADD CONSTRAINT FK_D0003D515A3D88EC FOREIGN KEY (id_sportif_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reservation_cour_salle ADD CONSTRAINT FK_D0003D5169098673 FOREIGN KEY (id_cour_id) REFERENCES cour_salle (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reservation_cour_salle');
    }
}
