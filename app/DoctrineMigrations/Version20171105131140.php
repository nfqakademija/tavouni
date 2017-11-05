<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171105131140 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX IDX_1F7B776DE5D32D49 ON groups_students');
        $this->addSql('ALTER TABLE groups_students DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE groups_students CHANGE group__id group_id INT NOT NULL');
        $this->addSql('ALTER TABLE groups_students ADD CONSTRAINT FK_1F7B776DCB944F1A FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groups_students ADD CONSTRAINT FK_1F7B776DFE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_1F7B776DFE54D947 ON groups_students (group_id)');
        $this->addSql('ALTER TABLE groups_students ADD PRIMARY KEY (student_id, group_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE groups_students DROP FOREIGN KEY FK_1F7B776DCB944F1A');
        $this->addSql('ALTER TABLE groups_students DROP FOREIGN KEY FK_1F7B776DFE54D947');
        $this->addSql('DROP INDEX IDX_1F7B776DFE54D947 ON groups_students');
        $this->addSql('ALTER TABLE groups_students DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE groups_students CHANGE group_id group__id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_1F7B776DE5D32D49 ON groups_students (group__id)');
        $this->addSql('ALTER TABLE groups_students ADD PRIMARY KEY (student_id, group__id)');
    }
}
