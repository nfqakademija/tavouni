<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171106181930 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE buildings ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE lecture_dates ADD end DATETIME NOT NULL, CHANGE date start DATETIME NOT NULL');
        $this->addSql('ALTER TABLE lectures ADD lecture_type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE groups DROP groupNo, CHANGE grouptype name VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE buildings DROP name');
        $this->addSql('ALTER TABLE groups ADD groupNo INT NOT NULL, CHANGE name groupType VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE lecture_dates ADD date DATETIME NOT NULL, DROP start, DROP end');
        $this->addSql('ALTER TABLE lectures DROP lecture_type');
    }
}
