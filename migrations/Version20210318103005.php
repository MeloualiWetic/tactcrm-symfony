<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318103005 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresses (id INT AUTO_INCREMENT NOT NULL, code_postal INT NOT NULL, numero INT NOT NULL, pays VARCHAR(25) DEFAULT NULL, rue VARCHAR(25) NOT NULL, ville VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(25) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details_facture (id INT AUTO_INCREMENT NOT NULL, facture_id INT NOT NULL, article_id INT NOT NULL, designation_produit VARCHAR(25) NOT NULL, qte INT NOT NULL, prix_vente DOUBLE PRECISION NOT NULL, INDEX IDX_18D51D017F2DEE08 (facture_id), INDEX IDX_18D51D017294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factures (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, date_facturation DATE NOT NULL, numero VARCHAR(25) NOT NULL, statut TINYINT(1) NOT NULL, description TINYTEXT DEFAULT NULL, INDEX IDX_647590BFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, adresse_id INT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(25) NOT NULL, prenom VARCHAR(25) NOT NULL, telephone VARCHAR(25) NOT NULL, email VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_497B315EF85E0677 (username), UNIQUE INDEX UNIQ_497B315E4DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE details_facture ADD CONSTRAINT FK_18D51D017F2DEE08 FOREIGN KEY (facture_id) REFERENCES factures (id)');
        $this->addSql('ALTER TABLE details_facture ADD CONSTRAINT FK_18D51D017294869C FOREIGN KEY (article_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE factures ADD CONSTRAINT FK_647590BFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315E4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresses (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315E4DE7DC5C');
        $this->addSql('ALTER TABLE details_facture DROP FOREIGN KEY FK_18D51D017294869C');
        $this->addSql('ALTER TABLE details_facture DROP FOREIGN KEY FK_18D51D017F2DEE08');
        $this->addSql('ALTER TABLE factures DROP FOREIGN KEY FK_647590BFB88E14F');
        $this->addSql('DROP TABLE adresses');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE details_facture');
        $this->addSql('DROP TABLE factures');
        $this->addSql('DROP TABLE utilisateurs');
    }
}
