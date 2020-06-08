<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200105122902 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE book CHANGE genre genre VARCHAR(255) DEFAULT NULL, CHANGE date_edition date_edition VARCHAR(255) DEFAULT NULL, CHANGE maison_edition maison_edition VARCHAR(255) DEFAULT NULL, CHANGE etat etat VARCHAR(255) DEFAULT NULL, CHANGE nombre_page nombre_page VARCHAR(255) DEFAULT NULL, CHANGE rate rate INT DEFAULT NULL, CHANGE num_rate num_rate INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart CHANGE date date VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE genre CHANGE num_book num_book INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review CHANGE rate rate INT DEFAULT NULL, CHANGE rate_nick rate_nick VARCHAR(255) DEFAULT NULL, CHANGE rate_summ rate_summ VARCHAR(255) DEFAULT NULL, CHANGE rate_rev rate_rev VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE subject CHANGE num_book num_book INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('ALTER TABLE book CHANGE genre genre VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE date_edition date_edition VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE maison_edition maison_edition VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE etat etat VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE nombre_page nombre_page VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE rate rate INT DEFAULT NULL, CHANGE num_rate num_rate INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart CHANGE date date DATE NOT NULL');
        $this->addSql('ALTER TABLE genre CHANGE num_book num_book INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review CHANGE rate rate INT DEFAULT NULL, CHANGE rate_nick rate_nick VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE rate_summ rate_summ VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE rate_rev rate_rev VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE subject CHANGE num_book num_book INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
