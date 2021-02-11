<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210205115328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE order_product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produce_order_product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, manager_id INT DEFAULT NULL, driver_id INT DEFAULT NULL, description TEXT DEFAULT NULL, deadline TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, file VARCHAR(255) DEFAULT NULL, shipped_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, buyer_phone VARCHAR(100) DEFAULT NULL, buyer_name VARCHAR(100) NOT NULL, buyer_last_name VARCHAR(100) DEFAULT NULL, buyer_address VARCHAR(255) DEFAULT NULL, shipping_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, payment_status VARCHAR(255) NOT NULL, prepaid DOUBLE PRECISION DEFAULT NULL, accountant_comment TEXT DEFAULT NULL, manager_comment TEXT DEFAULT NULL, supervisor_comment TEXT DEFAULT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F5299398783E3463 ON "order" (manager_id)');
        $this->addSql('CREATE INDEX IDX_F5299398C3423909 ON "order" (driver_id)');
        $this->addSql('CREATE TABLE order_product (id INT NOT NULL, order_id INT NOT NULL, product_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION DEFAULT NULL, fact_price DOUBLE PRECISION NOT NULL, spent_itr DOUBLE PRECISION NOT NULL, purchase DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2530ADE68D9F6D38 ON order_product (order_id)');
        $this->addSql('CREATE INDEX IDX_2530ADE64584665A ON order_product (product_id)');
        $this->addSql('CREATE TABLE produce_order_product (id INT NOT NULL, performer_id INT DEFAULT NULL, order_product_id INT NOT NULL, manager_comment TEXT DEFAULT NULL, spent_to_producing DOUBLE PRECISION DEFAULT NULL, spent_to_resources DOUBLE PRECISION DEFAULT NULL, spent_to_additional DOUBLE PRECISION DEFAULT NULL, salary_status VARCHAR(255) NOT NULL, salary_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_244F5B36C6B33F3 ON produce_order_product (performer_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_244F5B3F65E9B0F ON produce_order_product (order_product_id)');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, name VARCHAR(255) NOT NULL, article VARCHAR(100) NOT NULL, price DOUBLE PRECISION NOT NULL, description TEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398783E3463 FOREIGN KEY (manager_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398C3423909 FOREIGN KEY (driver_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE68D9F6D38 FOREIGN KEY (order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produce_order_product ADD CONSTRAINT FK_244F5B36C6B33F3 FOREIGN KEY (performer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produce_order_product ADD CONSTRAINT FK_244F5B3F65E9B0F FOREIGN KEY (order_product_id) REFERENCES order_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE order_product DROP CONSTRAINT FK_2530ADE68D9F6D38');
        $this->addSql('ALTER TABLE produce_order_product DROP CONSTRAINT FK_244F5B3F65E9B0F');
        $this->addSql('ALTER TABLE order_product DROP CONSTRAINT FK_2530ADE64584665A');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398783E3463');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398C3423909');
        $this->addSql('ALTER TABLE produce_order_product DROP CONSTRAINT FK_244F5B36C6B33F3');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE order_product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE produce_order_product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE produce_order_product');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE "user"');
    }
}
