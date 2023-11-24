<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231124143410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande CHANGE id_vehicule id_vehicule INT DEFAULT NULL, CHANGE id_membre id_membre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DD0834EC4 FOREIGN KEY (id_membre) REFERENCES membre (id_membre)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DD0834EC4 ON commande (id_membre)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DD0834EC4');
        $this->addSql('DROP INDEX IDX_6EEAA67DD0834EC4 ON commande');
        $this->addSql('ALTER TABLE commande CHANGE id_membre id_membre INT NOT NULL, CHANGE id_vehicule id_vehicule INT NOT NULL');
    }
}
