<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210921121925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, hook CLOB NOT NULL, content CLOB NOT NULL, image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE article_skill (article_id INTEGER NOT NULL, skill_id INTEGER NOT NULL, PRIMARY KEY(article_id, skill_id))');
        $this->addSql('CREATE INDEX IDX_298A96667294869C ON article_skill (article_id)');
        $this->addSql('CREATE INDEX IDX_298A96665585C142 ON article_skill (skill_id)');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE skill (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content CLOB NOT NULL, image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE skill_techno (skill_id INTEGER NOT NULL, techno_id INTEGER NOT NULL, PRIMARY KEY(skill_id, techno_id))');
        $this->addSql('CREATE INDEX IDX_16CDBAC85585C142 ON skill_techno (skill_id)');
        $this->addSql('CREATE INDEX IDX_16CDBAC851F3C1BC ON skill_techno (techno_id)');
        $this->addSql('CREATE TABLE techno (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content CLOB NOT NULL, image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE techno_category (techno_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(techno_id, category_id))');
        $this->addSql('CREATE INDEX IDX_22215BC651F3C1BC ON techno_category (techno_id)');
        $this->addSql('CREATE INDEX IDX_22215BC612469DE2 ON techno_category (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_skill');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_techno');
        $this->addSql('DROP TABLE techno');
        $this->addSql('DROP TABLE techno_category');
    }
}
