<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210520200946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mvc_project_monster_character (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, hp INT DEFAULT NULL, experience INT DEFAULT NULL, monster_rank INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE mvc_project_monster_log');
        $this->addSql('ALTER TABLE mvc_project_log CHANGE time time VARCHAR(255) DEFAULT NULL');
    }
}
