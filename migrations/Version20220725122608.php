<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725122608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, by_user_id INT NOT NULL, pupil_id INT DEFAULT NULL, description LONGTEXT NOT NULL, date_comment DATE NOT NULL, INDEX IDX_9474526CDC9C2434 (by_user_id), INDEX IDX_9474526CD2FD11 (pupil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, type VARCHAR(255) NOT NULL, date DATE NOT NULL, notes LONGTEXT DEFAULT NULL, INDEX IDX_3BAE0AA712469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_category (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, street_nb INT NOT NULL, street VARCHAR(255) NOT NULL, adress_complement VARCHAR(255) DEFAULT NULL, post_code INT NOT NULL, city VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_nb INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner_pupil (partner_id INT NOT NULL, pupil_id INT NOT NULL, INDEX IDX_D4E77ED49393F8FE (partner_id), INDEX IDX_D4E77ED4D2FD11 (pupil_id), PRIMARY KEY(partner_id, pupil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner_event (partner_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_2892A6C29393F8FE (partner_id), INDEX IDX_2892A6C271F7E88B (event_id), PRIMARY KEY(partner_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pupil (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, legal_representative VARCHAR(255) NOT NULL, classroom VARCHAR(255) NOT NULL, street_nb INT NOT NULL, street VARCHAR(255) NOT NULL, adress_complement VARCHAR(255) DEFAULT NULL, post_code INT NOT NULL, city VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_nb INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pupil_event (pupil_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_F680B48FD2FD11 (pupil_id), INDEX IDX_F680B48F71F7E88B (event_id), PRIMARY KEY(pupil_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CDC9C2434 FOREIGN KEY (by_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CD2FD11 FOREIGN KEY (pupil_id) REFERENCES pupil (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA712469DE2 FOREIGN KEY (category_id) REFERENCES event_category (id)');
        $this->addSql('ALTER TABLE partner_pupil ADD CONSTRAINT FK_D4E77ED49393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partner_pupil ADD CONSTRAINT FK_D4E77ED4D2FD11 FOREIGN KEY (pupil_id) REFERENCES pupil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partner_event ADD CONSTRAINT FK_2892A6C29393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partner_event ADD CONSTRAINT FK_2892A6C271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pupil_event ADD CONSTRAINT FK_F680B48FD2FD11 FOREIGN KEY (pupil_id) REFERENCES pupil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pupil_event ADD CONSTRAINT FK_F680B48F71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partner_event DROP FOREIGN KEY FK_2892A6C271F7E88B');
        $this->addSql('ALTER TABLE pupil_event DROP FOREIGN KEY FK_F680B48F71F7E88B');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA712469DE2');
        $this->addSql('ALTER TABLE partner_pupil DROP FOREIGN KEY FK_D4E77ED49393F8FE');
        $this->addSql('ALTER TABLE partner_event DROP FOREIGN KEY FK_2892A6C29393F8FE');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CD2FD11');
        $this->addSql('ALTER TABLE partner_pupil DROP FOREIGN KEY FK_D4E77ED4D2FD11');
        $this->addSql('ALTER TABLE pupil_event DROP FOREIGN KEY FK_F680B48FD2FD11');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CDC9C2434');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_category');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE partner_pupil');
        $this->addSql('DROP TABLE partner_event');
        $this->addSql('DROP TABLE pupil');
        $this->addSql('DROP TABLE pupil_event');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
