<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190328134536 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category_price DROP FOREIGN KEY FK_22FB6D90F77D927C');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479F77D927C');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP INDEX IDX_957A6479F77D927C ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP panier_id');
        $this->addSql('DROP INDEX IDX_22FB6D90F77D927C ON category_price');
        $this->addSql('ALTER TABLE category_price DROP panier_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, active TINYINT(1) NOT NULL, nbr_place INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category_price ADD panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category_price ADD CONSTRAINT FK_22FB6D90F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_22FB6D90F77D927C ON category_price (panier_id)');
        $this->addSql('ALTER TABLE fos_user ADD panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_957A6479F77D927C ON fos_user (panier_id)');
    }
}
