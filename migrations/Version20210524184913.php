<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524184913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mvc_project_monster_dice (id INT AUTO_INCREMENT NOT NULL, monster_id INT NOT NULL, dice VARCHAR(255) NOT NULL, faces INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mvc_project_monster_character CHANGE hp hp INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mvc_project_monster_dice');
        $this->addSql('ALTER TABLE mvc_project_monster_character CHANGE hp hp DOUBLE PRECISION DEFAULT NULL');
    }
}
