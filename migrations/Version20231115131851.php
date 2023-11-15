<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115131851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande CHANGE id_commande id_commande INT AUTO_INCREMENT NOT NULL, CHANGE id_membre id_membre INT NOT NULL, CHANGE id_vehicule id_vehicule INT NOT NULL, CHANGE prix_total prix_total INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande CHANGE id_commande id_commande SMALLINT AUTO_INCREMENT NOT NULL, CHANGE id_membre id_membre SMALLINT NOT NULL, CHANGE id_vehicule id_vehicule SMALLINT NOT NULL, CHANGE prix_total prix_total SMALLINT NOT NULL');
    }
}
