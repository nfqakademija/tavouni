<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171205125247 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE assignment_events (id INT AUTO_INCREMENT NOT NULL, room_id INT NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, INDEX IDX_6BA6775754177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assignment_events ADD CONSTRAINT FK_6BA6775754177093 FOREIGN KEY (room_id) REFERENCES rooms (id)');
        $this->addSql('ALTER TABLE subjects ADD lecturer_id INT NOT NULL');
        $this->addSql('ALTER TABLE subjects ADD CONSTRAINT FK_AB259917BA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturers (id)');
        $this->addSql('CREATE INDEX IDX_AB259917BA2D8762 ON subjects (lecturer_id)');
        $this->addSql('ALTER TABLE lecture_dates DROP type');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE assignment_events');
        $this->addSql('ALTER TABLE lecture_dates ADD type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE subjects DROP FOREIGN KEY FK_AB259917BA2D8762');
        $this->addSql('DROP INDEX IDX_AB259917BA2D8762 ON subjects');
        $this->addSql('ALTER TABLE subjects DROP lecturer_id');
    }
}
