<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216101153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, code_postal INT NOT NULL, numero INT NOT NULL, pays VARCHAR(25) DEFAULT NULL, rue VARCHAR(25) NOT NULL, ville VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(25) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_facture (id INT AUTO_INCREMENT NOT NULL, facture_id INT NOT NULL, article_id INT NOT NULL, designation_produit VARCHAR(25) NOT NULL, qte INT NOT NULL, prix_vente DOUBLE PRECISION NOT NULL, INDEX IDX_9949E4C57F2DEE08 (facture_id), INDEX IDX_9949E4C57294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, date_facturation DATE NOT NULL, numero VARCHAR(25) NOT NULL, INDEX IDX_FE866410FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, adresse_id INT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(25) NOT NULL, prenom VARCHAR(25) NOT NULL, telephone VARCHAR(25) NOT NULL, email VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3F85E0677 (username), UNIQUE INDEX UNIQ_1D1C63B34DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C57F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C57294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B34DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B34DE7DC5C');
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C57294869C');
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C57F2DEE08');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410FB88E14F');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE detail_facture');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE utilisateur');
    }
}
