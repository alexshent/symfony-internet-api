<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241121031058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE location (id SERIAL NOT NULL, customer_id INT DEFAULT NULL, address VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, tariff VARCHAR(255) NOT NULL, balance NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E9E89CB9395C3F3 ON location (customer_id)');
        $this->addSql('CREATE TABLE location_service (location_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(location_id, service_id))');
        $this->addSql('CREATE INDEX IDX_FD8897664D218E ON location_service (location_id)');
        $this->addSql('CREATE INDEX IDX_FD88976ED5CA9E6 ON location_service (service_id)');
        $this->addSql('CREATE TABLE service (id SERIAL NOT NULL, value VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, language VARCHAR(2) DEFAULT NULL, theme VARCHAR(255) DEFAULT NULL, device_id VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON "user" (username)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB9395C3F3 FOREIGN KEY (customer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE location_service ADD CONSTRAINT FK_FD8897664D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE location_service ADD CONSTRAINT FK_FD88976ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE location DROP CONSTRAINT FK_5E9E89CB9395C3F3');
        $this->addSql('ALTER TABLE location_service DROP CONSTRAINT FK_FD8897664D218E');
        $this->addSql('ALTER TABLE location_service DROP CONSTRAINT FK_FD88976ED5CA9E6');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE location_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE "user"');
    }
}
