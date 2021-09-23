<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210922134041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('DROP INDEX IDX_298A96665585C142');
        $this->addSql('DROP INDEX IDX_298A96667294869C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article_skill AS SELECT article_id, skill_id FROM article_skill');
        $this->addSql('DROP TABLE article_skill');
        $this->addSql('CREATE TABLE article_skill (article_id INTEGER NOT NULL, skill_id INTEGER NOT NULL, PRIMARY KEY(article_id, skill_id), CONSTRAINT FK_298A96667294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_298A96665585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article_skill (article_id, skill_id) SELECT article_id, skill_id FROM __temp__article_skill');
        $this->addSql('DROP TABLE __temp__article_skill');
        $this->addSql('CREATE INDEX IDX_298A96665585C142 ON article_skill (skill_id)');
        $this->addSql('CREATE INDEX IDX_298A96667294869C ON article_skill (article_id)');
        $this->addSql('DROP INDEX IDX_16CDBAC851F3C1BC');
        $this->addSql('DROP INDEX IDX_16CDBAC85585C142');
        $this->addSql('CREATE TEMPORARY TABLE __temp__skill_techno AS SELECT skill_id, techno_id FROM skill_techno');
        $this->addSql('DROP TABLE skill_techno');
        $this->addSql('CREATE TABLE skill_techno (skill_id INTEGER NOT NULL, techno_id INTEGER NOT NULL, PRIMARY KEY(skill_id, techno_id), CONSTRAINT FK_16CDBAC85585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_16CDBAC851F3C1BC FOREIGN KEY (techno_id) REFERENCES techno (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO skill_techno (skill_id, techno_id) SELECT skill_id, techno_id FROM __temp__skill_techno');
        $this->addSql('DROP TABLE __temp__skill_techno');
        $this->addSql('CREATE INDEX IDX_16CDBAC851F3C1BC ON skill_techno (techno_id)');
        $this->addSql('CREATE INDEX IDX_16CDBAC85585C142 ON skill_techno (skill_id)');
        $this->addSql('DROP INDEX IDX_22215BC612469DE2');
        $this->addSql('DROP INDEX IDX_22215BC651F3C1BC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__techno_category AS SELECT techno_id, category_id FROM techno_category');
        $this->addSql('DROP TABLE techno_category');
        $this->addSql('CREATE TABLE techno_category (techno_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(techno_id, category_id), CONSTRAINT FK_22215BC651F3C1BC FOREIGN KEY (techno_id) REFERENCES techno (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_22215BC612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO techno_category (techno_id, category_id) SELECT techno_id, category_id FROM __temp__techno_category');
        $this->addSql('DROP TABLE __temp__techno_category');
        $this->addSql('CREATE INDEX IDX_22215BC612469DE2 ON techno_category (category_id)');
        $this->addSql('CREATE INDEX IDX_22215BC651F3C1BC ON techno_category (techno_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_298A96667294869C');
        $this->addSql('DROP INDEX IDX_298A96665585C142');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article_skill AS SELECT article_id, skill_id FROM article_skill');
        $this->addSql('DROP TABLE article_skill');
        $this->addSql('CREATE TABLE article_skill (article_id INTEGER NOT NULL, skill_id INTEGER NOT NULL, PRIMARY KEY(article_id, skill_id))');
        $this->addSql('INSERT INTO article_skill (article_id, skill_id) SELECT article_id, skill_id FROM __temp__article_skill');
        $this->addSql('DROP TABLE __temp__article_skill');
        $this->addSql('CREATE INDEX IDX_298A96667294869C ON article_skill (article_id)');
        $this->addSql('CREATE INDEX IDX_298A96665585C142 ON article_skill (skill_id)');
        $this->addSql('DROP INDEX IDX_16CDBAC85585C142');
        $this->addSql('DROP INDEX IDX_16CDBAC851F3C1BC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__skill_techno AS SELECT skill_id, techno_id FROM skill_techno');
        $this->addSql('DROP TABLE skill_techno');
        $this->addSql('CREATE TABLE skill_techno (skill_id INTEGER NOT NULL, techno_id INTEGER NOT NULL, PRIMARY KEY(skill_id, techno_id))');
        $this->addSql('INSERT INTO skill_techno (skill_id, techno_id) SELECT skill_id, techno_id FROM __temp__skill_techno');
        $this->addSql('DROP TABLE __temp__skill_techno');
        $this->addSql('CREATE INDEX IDX_16CDBAC85585C142 ON skill_techno (skill_id)');
        $this->addSql('CREATE INDEX IDX_16CDBAC851F3C1BC ON skill_techno (techno_id)');
        $this->addSql('DROP INDEX IDX_22215BC651F3C1BC');
        $this->addSql('DROP INDEX IDX_22215BC612469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__techno_category AS SELECT techno_id, category_id FROM techno_category');
        $this->addSql('DROP TABLE techno_category');
        $this->addSql('CREATE TABLE techno_category (techno_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(techno_id, category_id))');
        $this->addSql('INSERT INTO techno_category (techno_id, category_id) SELECT techno_id, category_id FROM __temp__techno_category');
        $this->addSql('DROP TABLE __temp__techno_category');
        $this->addSql('CREATE INDEX IDX_22215BC651F3C1BC ON techno_category (techno_id)');
        $this->addSql('CREATE INDEX IDX_22215BC612469DE2 ON techno_category (category_id)');
    }
}
