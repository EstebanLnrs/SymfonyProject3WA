<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305100421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, resume VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fighter ADD resume_id INT NOT NULL');
        $this->addSql('ALTER TABLE fighter ADD CONSTRAINT FK_7A08C3FCD262AF09 FOREIGN KEY (resume_id) REFERENCES score (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A08C3FCD262AF09 ON fighter (resume_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fighter DROP FOREIGN KEY FK_7A08C3FCD262AF09');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP INDEX UNIQ_7A08C3FCD262AF09 ON fighter');
        $this->addSql('ALTER TABLE fighter DROP resume_id');
    }
}
