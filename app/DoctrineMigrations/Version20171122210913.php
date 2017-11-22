<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171122210913 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE students_assignments (assignment_id INT NOT NULL, student_id INT NOT NULL, grade INT NOT NULL, INDEX IDX_DE2DA19AD19302F8 (assignment_id), INDEX IDX_DE2DA19ACB944F1A (student_id), PRIMARY KEY(assignment_id, student_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assignments (id INT AUTO_INCREMENT NOT NULL, subject_id INT DEFAULT NULL, lecture_type_id INT DEFAULT NULL, weight INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_308A50DD23EDC87 (subject_id), INDEX IDX_308A50DDF308DFC7 (lecture_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecture_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE students_assignments ADD CONSTRAINT FK_DE2DA19AD19302F8 FOREIGN KEY (assignment_id) REFERENCES assignments (id)');
        $this->addSql('ALTER TABLE students_assignments ADD CONSTRAINT FK_DE2DA19ACB944F1A FOREIGN KEY (student_id) REFERENCES students (id)');
        $this->addSql('ALTER TABLE assignments ADD CONSTRAINT FK_308A50DD23EDC87 FOREIGN KEY (subject_id) REFERENCES subjects (id)');
        $this->addSql('ALTER TABLE assignments ADD CONSTRAINT FK_308A50DDF308DFC7 FOREIGN KEY (lecture_type_id) REFERENCES lecture_type (id)');
        $this->addSql('ALTER TABLE lectures ADD lecture_type_id INT DEFAULT NULL, DROP lecture_type');
        $this->addSql('ALTER TABLE lectures ADD CONSTRAINT FK_63C861D0F308DFC7 FOREIGN KEY (lecture_type_id) REFERENCES lecture_type (id)');
        $this->addSql('CREATE INDEX IDX_63C861D0F308DFC7 ON lectures (lecture_type_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE students_assignments DROP FOREIGN KEY FK_DE2DA19AD19302F8');
        $this->addSql('ALTER TABLE lectures DROP FOREIGN KEY FK_63C861D0F308DFC7');
        $this->addSql('ALTER TABLE assignments DROP FOREIGN KEY FK_308A50DDF308DFC7');
        $this->addSql('DROP TABLE students_assignments');
        $this->addSql('DROP TABLE assignments');
        $this->addSql('DROP TABLE lecture_type');
        $this->addSql('DROP INDEX IDX_63C861D0F308DFC7 ON lectures');
        $this->addSql('ALTER TABLE lectures ADD lecture_type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP lecture_type_id');
    }
}
