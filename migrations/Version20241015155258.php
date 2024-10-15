<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241015155258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, country VARCHAR(120) NOT NULL, city VARCHAR(120) NOT NULL, code_postal VARCHAR(120) NOT NULL, street VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, description VARCHAR(255) DEFAULT NULL, type VARCHAR(180) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ergonomy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hall (id INT AUTO_INCREMENT NOT NULL, event_type_id_id INT NOT NULL, addresse_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, area VARCHAR(120) NOT NULL, accessibility VARCHAR(255) NOT NULL, capacity_max INT NOT NULL, price_per_hour NUMERIC(5, 2) NOT NULL, opening_time TIME NOT NULL, closing_time TIME NOT NULL, main_img VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1B8FA83F29A6C08F (event_type_id_id), UNIQUE INDEX UNIQ_1B8FA83FC2360D68 (addresse_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hall_equipment (id INT AUTO_INCREMENT NOT NULL, hall_id_id INT NOT NULL, equipment_id_id INT NOT NULL, UNIQUE INDEX UNIQ_B7E2D29DE54EF918 (hall_id_id), UNIQUE INDEX UNIQ_B7E2D29D961DBFB3 (equipment_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hall_ergonomy (id INT AUTO_INCREMENT NOT NULL, hall_id_id INT NOT NULL, ergonomy_id_id INT NOT NULL, UNIQUE INDEX UNIQ_581A618CE54EF918 (hall_id_id), UNIQUE INDEX UNIQ_581A618CA6DF3F79 (ergonomy_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hall_image (id INT AUTO_INCREMENT NOT NULL, hall_id_id INT NOT NULL, img_id_id INT NOT NULL, UNIQUE INDEX UNIQ_5F376310E54EF918 (hall_id_id), UNIQUE INDEX UNIQ_5F37631057883738 (img_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(120) NOT NULL, img VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, message VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_read TINYINT(1) NOT NULL, INDEX IDX_BF5476CA9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, hall_id_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, start_time TIME NOT NULL, end_time TIME NOT NULL, is_confirmed TINYINT(1) NOT NULL, special_request VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_42C849559D86650F (user_id_id), INDEX IDX_42C84955E54EF918 (hall_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hall ADD CONSTRAINT FK_1B8FA83F29A6C08F FOREIGN KEY (event_type_id_id) REFERENCES event_type (id)');
        $this->addSql('ALTER TABLE hall ADD CONSTRAINT FK_1B8FA83FC2360D68 FOREIGN KEY (addresse_id_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE hall_equipment ADD CONSTRAINT FK_B7E2D29DE54EF918 FOREIGN KEY (hall_id_id) REFERENCES hall (id)');
        $this->addSql('ALTER TABLE hall_equipment ADD CONSTRAINT FK_B7E2D29D961DBFB3 FOREIGN KEY (equipment_id_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE hall_ergonomy ADD CONSTRAINT FK_581A618CE54EF918 FOREIGN KEY (hall_id_id) REFERENCES hall (id)');
        $this->addSql('ALTER TABLE hall_ergonomy ADD CONSTRAINT FK_581A618CA6DF3F79 FOREIGN KEY (ergonomy_id_id) REFERENCES ergonomy (id)');
        $this->addSql('ALTER TABLE hall_image ADD CONSTRAINT FK_5F376310E54EF918 FOREIGN KEY (hall_id_id) REFERENCES hall (id)');
        $this->addSql('ALTER TABLE hall_image ADD CONSTRAINT FK_5F37631057883738 FOREIGN KEY (img_id_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955E54EF918 FOREIGN KEY (hall_id_id) REFERENCES hall (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hall DROP FOREIGN KEY FK_1B8FA83F29A6C08F');
        $this->addSql('ALTER TABLE hall DROP FOREIGN KEY FK_1B8FA83FC2360D68');
        $this->addSql('ALTER TABLE hall_equipment DROP FOREIGN KEY FK_B7E2D29DE54EF918');
        $this->addSql('ALTER TABLE hall_equipment DROP FOREIGN KEY FK_B7E2D29D961DBFB3');
        $this->addSql('ALTER TABLE hall_ergonomy DROP FOREIGN KEY FK_581A618CE54EF918');
        $this->addSql('ALTER TABLE hall_ergonomy DROP FOREIGN KEY FK_581A618CA6DF3F79');
        $this->addSql('ALTER TABLE hall_image DROP FOREIGN KEY FK_5F376310E54EF918');
        $this->addSql('ALTER TABLE hall_image DROP FOREIGN KEY FK_5F37631057883738');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA9D86650F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559D86650F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955E54EF918');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE ergonomy');
        $this->addSql('DROP TABLE event_type');
        $this->addSql('DROP TABLE hall');
        $this->addSql('DROP TABLE hall_equipment');
        $this->addSql('DROP TABLE hall_ergonomy');
        $this->addSql('DROP TABLE hall_image');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
