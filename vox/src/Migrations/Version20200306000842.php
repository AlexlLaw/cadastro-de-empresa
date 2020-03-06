<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200306000842 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE socio_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE empresa_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE socio (id INT NOT NULL, empresa_id_id INT NOT NULL, nome VARCHAR(255) DEFAULT NULL, cpf VARCHAR(20) DEFAULT NULL, telefone VARCHAR(11) NOT NULL, endereco VARCHAR(255) NOT NULL, cargo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_38B65309FB9F83DE ON socio (empresa_id_id)');
        $this->addSql('CREATE TABLE empresa (id INT NOT NULL, nome_da_empresa VARCHAR(255) NOT NULL, cnpj VARCHAR(20) NOT NULL, telefone VARCHAR(15) NOT NULL, endereco VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE socio ADD CONSTRAINT FK_38B65309FB9F83DE FOREIGN KEY (empresa_id_id) REFERENCES empresa (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE socio DROP CONSTRAINT FK_38B65309FB9F83DE');
        $this->addSql('DROP SEQUENCE socio_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE empresa_id_seq CASCADE');
        $this->addSql('DROP TABLE socio');
        $this->addSql('DROP TABLE empresa');
    }
}
