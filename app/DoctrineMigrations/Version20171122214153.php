<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171122214153 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE grades (assignment_id INT NOT NULL, student_id INT NOT NULL, grade INT NOT NULL, INDEX IDX_3AE36110D19302F8 (assignment_id), INDEX IDX_3AE36110CB944F1A (student_id), PRIMARY KEY(assignment_id, student_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE36110D19302F8 FOREIGN KEY (assignment_id) REFERENCES assignments (id)');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE36110CB944F1A FOREIGN KEY (student_id) REFERENCES students (id)');
        $this->addSql('DROP TABLE students_assignments');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE students_assignments (assignment_id INT NOT NULL, student_id INT NOT NULL, grade INT NOT NULL, INDEX IDX_DE2DA19AD19302F8 (assignment_id), INDEX IDX_DE2DA19ACB944F1A (student_id), PRIMARY KEY(assignment_id, student_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE students_assignments ADD CONSTRAINT FK_DE2DA19ACB944F1A FOREIGN KEY (student_id) REFERENCES students (id)');
        $this->addSql('ALTER TABLE students_assignments ADD CONSTRAINT FK_DE2DA19AD19302F8 FOREIGN KEY (assignment_id) REFERENCES assignments (id)');
        $this->addSql('DROP TABLE grades');
    }
}
