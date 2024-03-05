<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240304145413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fighter_categories (fighter_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_CFA1D95934934341 (fighter_id), INDEX IDX_CFA1D959A21214B7 (categories_id), PRIMARY KEY(fighter_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fighter_categories ADD CONSTRAINT FK_CFA1D95934934341 FOREIGN KEY (fighter_id) REFERENCES fighter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fighter_categories ADD CONSTRAINT FK_CFA1D959A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fighter ADD organisation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fighter ADD CONSTRAINT FK_7A08C3FC9E6B1585 FOREIGN KEY (organisation_id) REFERENCES organisation (id)');
        $this->addSql('CREATE INDEX IDX_7A08C3FC9E6B1585 ON fighter (organisation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fighter DROP FOREIGN KEY FK_7A08C3FC9E6B1585');
        $this->addSql('ALTER TABLE fighter_categories DROP FOREIGN KEY FK_CFA1D95934934341');
        $this->addSql('ALTER TABLE fighter_categories DROP FOREIGN KEY FK_CFA1D959A21214B7');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE fighter_categories');
        $this->addSql('DROP TABLE organisation');
        $this->addSql('DROP INDEX IDX_7A08C3FC9E6B1585 ON fighter');
        $this->addSql('ALTER TABLE fighter DROP organisation_id');
    }
}
