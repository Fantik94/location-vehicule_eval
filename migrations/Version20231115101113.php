<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115101113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande CHANGE id_commande id_commande INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id_commande)');
        $this->addSql('ALTER TABLE membre CHANGE id_membre id_membre INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id_membre)');
        $this->addSql('ALTER TABLE vehicule CHANGE titre titre VARCHAR(200) NOT NULL, CHANGE marque marque VARCHAR(50) NOT NULL, CHANGE modele modele VARCHAR(50) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE photo photo VARCHAR(200) NOT NULL, CHANGE prix_journalier prix_journalier INT NOT NULL, CHANGE date_enregistrement date_enregistrement DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande MODIFY id_commande INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON commande');
        $this->addSql('ALTER TABLE commande CHANGE id_commande id_commande INT NOT NULL');
        $this->addSql('ALTER TABLE membre MODIFY id_membre INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON membre');
        $this->addSql('ALTER TABLE membre CHANGE id_membre id_membre INT NOT NULL');
        $this->addSql('ALTER TABLE vehicule CHANGE titre titre VARCHAR(200) DEFAULT NULL, CHANGE marque marque VARCHAR(50) DEFAULT NULL, CHANGE modele modele VARCHAR(50) DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE photo photo VARCHAR(200) DEFAULT NULL, CHANGE prix_journalier prix_journalier INT DEFAULT NULL, CHANGE date_enregistrement date_enregistrement DATETIME DEFAULT NULL');
    }
}
