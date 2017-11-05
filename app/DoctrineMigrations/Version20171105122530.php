<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171105122530 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lecture_date CHANGE lectureid lecture_id INT NOT NULL');
        $this->addSql('ALTER TABLE lecture_date ADD CONSTRAINT FK_1676805535E32FCD FOREIGN KEY (lecture_id) REFERENCES lecture (id)');
        $this->addSql('CREATE INDEX IDX_1676805535E32FCD ON lecture_date (lecture_id)');
        $this->addSql('ALTER TABLE lecture CHANGE groupid group_id INT NOT NULL');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C1677948FE54D947 FOREIGN KEY (group_id) REFERENCES group_ (id)');
        $this->addSql('CREATE INDEX IDX_C1677948FE54D947 ON lecture (group_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C1677948FE54D947');
        $this->addSql('DROP INDEX IDX_C1677948FE54D947 ON lecture');
        $this->addSql('ALTER TABLE lecture CHANGE group_id groupId INT NOT NULL');
        $this->addSql('ALTER TABLE lecture_date DROP FOREIGN KEY FK_1676805535E32FCD');
        $this->addSql('DROP INDEX IDX_1676805535E32FCD ON lecture_date');
        $this->addSql('ALTER TABLE lecture_date CHANGE lecture_id lectureId INT NOT NULL');
    }
}
