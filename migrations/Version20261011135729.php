<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261011135729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translations DROP FOREIGN KEY `FK_C6B7DA87E357438D`');
        $this->addSql('ALTER TABLE translations CHANGE word_id word_id INT NOT NULL');
        $this->addSql('ALTER TABLE translations ADD CONSTRAINT FK_C6B7DA87E357438D FOREIGN KEY (word_id) REFERENCES words (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX uniq_translation_word_position ON translations (word_id, position)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translations DROP FOREIGN KEY FK_C6B7DA87E357438D');
        $this->addSql('DROP INDEX uniq_translation_word_position ON translations');
        $this->addSql('ALTER TABLE translations CHANGE word_id word_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE translations ADD CONSTRAINT `FK_C6B7DA87E357438D` FOREIGN KEY (word_id) REFERENCES words (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
