<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241019144912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration to create basic tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id SERIAL NOT NULL, state TEXT NOT NULL, city TEXT NOT NULL, zip VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE client (id SERIAL NOT NULL, address_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, age SMALLINT NOT NULL, ssn VARCHAR(11) NOT NULL, fico SMALLINT NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455E7927C74 ON client (email)');
        $this->addSql('CREATE INDEX IDX_C7440455F5B7AF75 ON client (address_id)');
        $this->addSql('CREATE TABLE client_product (client_id INT NOT NULL, product_id INT NOT NULL, PRIMARY KEY(client_id, product_id))');
        $this->addSql('CREATE INDEX IDX_817740D019EB6921 ON client_product (client_id)');
        $this->addSql('CREATE INDEX IDX_817740D04584665A ON client_product (product_id)');
        $this->addSql('CREATE TABLE history (id SERIAL NOT NULL, client_id INT NOT NULL, product_id INT NOT NULL, dt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, loan_balance DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_27BA704B19EB6921 ON history (client_id)');
        $this->addSql('CREATE INDEX IDX_27BA704B4584665A ON history (product_id)');
        $this->addSql('CREATE TABLE product (id SERIAL NOT NULL, name TEXT NOT NULL, period INT NOT NULL, interval_rage NUMERIC(2, 2) NOT NULL, sum DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client_product ADD CONSTRAINT FK_817740D019EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client_product ADD CONSTRAINT FK_817740D04584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455F5B7AF75');
        $this->addSql('ALTER TABLE client_product DROP CONSTRAINT FK_817740D019EB6921');
        $this->addSql('ALTER TABLE client_product DROP CONSTRAINT FK_817740D04584665A');
        $this->addSql('ALTER TABLE history DROP CONSTRAINT FK_27BA704B19EB6921');
        $this->addSql('ALTER TABLE history DROP CONSTRAINT FK_27BA704B4584665A');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_product');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE product');
    }
}
