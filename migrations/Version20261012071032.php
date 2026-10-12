<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261012071032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Noun (gender VARCHAR(255) NOT NULL, animacy VARCHAR(255) NOT NULL, id INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE PartOfSpeech (id INT AUTO_INCREMENT NOT NULL, translation_id INT NOT NULL, part_of_speech_type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_AD49FE1B9CAA2B25 (translation_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE Verb (composition VARCHAR(255) NOT NULL, pastForm VARCHAR(255) NOT NULL, presentForm VARCHAR(255) NOT NULL, id INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE Noun ADD CONSTRAINT FK_E146BDE3BF396750 FOREIGN KEY (id) REFERENCES PartOfSpeech (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PartOfSpeech ADD CONSTRAINT FK_AD49FE1B9CAA2B25 FOREIGN KEY (translation_id) REFERENCES translations (id)');
        $this->addSql('ALTER TABLE Verb ADD CONSTRAINT FK_3F8B9DA9BF396750 FOREIGN KEY (id) REFERENCES PartOfSpeech (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Noun DROP FOREIGN KEY FK_E146BDE3BF396750');
        $this->addSql('ALTER TABLE PartOfSpeech DROP FOREIGN KEY FK_AD49FE1B9CAA2B25');
        $this->addSql('ALTER TABLE Verb DROP FOREIGN KEY FK_3F8B9DA9BF396750');
        $this->addSql('DROP TABLE Noun');
        $this->addSql('DROP TABLE PartOfSpeech');
        $this->addSql('DROP TABLE Verb');
    }
}
