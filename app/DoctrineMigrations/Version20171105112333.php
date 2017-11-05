<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171105112333 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lecture CHANGE lecturerid lecturer_id INT NOT NULL');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C1677948BA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturer (id)');
        $this->addSql('CREATE INDEX IDX_C1677948BA2D8762 ON lecture (lecturer_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C1677948BA2D8762');
        $this->addSql('DROP INDEX IDX_C1677948BA2D8762 ON lecture');
        $this->addSql('ALTER TABLE lecture CHANGE lecturer_id lecturerId INT NOT NULL');
    }
}
