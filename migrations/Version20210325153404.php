<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325153404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE depenses (id INT AUTO_INCREMENT NOT NULL, devise_id INT NOT NULL, type_depense_id INT NOT NULL, type_paiement_id INT NOT NULL, nom VARCHAR(25) NOT NULL, date_depense DATE NOT NULL, nontant DOUBLE PRECISION NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_EE350ECBF4445056 (devise_id), INDEX IDX_EE350ECB5CDBC346 (type_depense_id), INDEX IDX_EE350ECB615593E9 (type_paiement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE depenses ADD CONSTRAINT FK_EE350ECBF4445056 FOREIGN KEY (devise_id) REFERENCES devises (id)');
        $this->addSql('ALTER TABLE depenses ADD CONSTRAINT FK_EE350ECB5CDBC346 FOREIGN KEY (type_depense_id) REFERENCES types_depenses (id)');
        $this->addSql('ALTER TABLE depenses ADD CONSTRAINT FK_EE350ECB615593E9 FOREIGN KEY (type_paiement_id) REFERENCES types_paiements (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE depenses');
    }
}
