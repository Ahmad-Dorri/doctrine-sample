<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261011134950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE translations (id INT AUTO_INCREMENT NOT NULL, text VARCHAR(255) NOT NULL, position INT NOT NULL, word_id INT DEFAULT NULL, INDEX IDX_C6B7DA87E357438D (word_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE translations ADD CONSTRAINT FK_C6B7DA87E357438D FOREIGN KEY (word_id) REFERENCES words (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translations DROP FOREIGN KEY FK_C6B7DA87E357438D');
        $this->addSql('DROP TABLE translations');
    }
}
