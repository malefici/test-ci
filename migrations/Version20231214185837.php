<?php

declare(strict_types=1);

namespace Malefici\TestCi\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214185837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE newsletter ADD COLUMN title VARCHAR(80) DEFAULT \'Title (default)\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__newsletter AS SELECT id, content FROM newsletter');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('CREATE TABLE newsletter (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content CLOB NOT NULL)');
        $this->addSql('INSERT INTO newsletter (id, content) SELECT id, content FROM __temp__newsletter');
        $this->addSql('DROP TABLE __temp__newsletter');
    }
}
