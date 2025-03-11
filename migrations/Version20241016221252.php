<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241016221252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__track AS SELECT id, release_id, title, duration FROM track');
        $this->addSql('DROP TABLE track');
        $this->addSql('CREATE TABLE track (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, release_id INTEGER NOT NULL, owner_id INTEGER DEFAULT 2 NOT NULL, title VARCHAR(255) NOT NULL, duration INTEGER NOT NULL, CONSTRAINT FK_D6E3F8A6B12A727D FOREIGN KEY (release_id) REFERENCES "release" (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D6E3F8A67E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO track (id, release_id, title, duration) SELECT id, release_id, title, duration FROM __temp__track');
        $this->addSql('DROP TABLE __temp__track');
        $this->addSql('CREATE INDEX IDX_D6E3F8A6B12A727D ON track (release_id)');
        $this->addSql('CREATE INDEX IDX_D6E3F8A67E3C61F9 ON track (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__track AS SELECT id, release_id, title, duration FROM track');
        $this->addSql('DROP TABLE track');
        $this->addSql('CREATE TABLE track (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, release_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, duration INTEGER NOT NULL, CONSTRAINT FK_D6E3F8A6B12A727D FOREIGN KEY (release_id) REFERENCES "release" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO track (id, release_id, title, duration) SELECT id, release_id, title, duration FROM __temp__track');
        $this->addSql('DROP TABLE __temp__track');
        $this->addSql('CREATE INDEX IDX_D6E3F8A6B12A727D ON track (release_id)');
    }
}
