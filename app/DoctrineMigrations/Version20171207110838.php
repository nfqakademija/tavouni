<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171207110838 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE buildings (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, lecture_id INT DEFAULT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, publishedAt DATETIME NOT NULL, INDEX IDX_885DBAFA35E32FCD (lecture_id), INDEX IDX_885DBAFAF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seen_posts_students (post_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_E9258CFA4B89032C (post_id), INDEX IDX_E9258CFACB944F1A (student_id), PRIMARY KEY(post_id, student_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecture_dates (id INT AUTO_INCREMENT NOT NULL, lecture_id INT NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, INDEX IDX_191CF035E32FCD (lecture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lectures (id INT AUTO_INCREMENT NOT NULL, subject_id INT NOT NULL, lecturer_id INT NOT NULL, group_id INT NOT NULL, room_id INT NOT NULL, lecture_type_id INT DEFAULT NULL, INDEX IDX_63C861D023EDC87 (subject_id), INDEX IDX_63C861D0BA2D8762 (lecturer_id), INDEX IDX_63C861D0FE54D947 (group_id), INDEX IDX_63C861D054177093 (room_id), INDEX IDX_63C861D0F308DFC7 (lecture_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_1483A5E992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1483A5E9A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_1483A5E9C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grades (id INT AUTO_INCREMENT NOT NULL, assignment_id INT DEFAULT NULL, student_id INT DEFAULT NULL, grade INT NOT NULL, INDEX IDX_3AE36110D19302F8 (assignment_id), INDEX IDX_3AE36110CB944F1A (student_id), UNIQUE INDEX grade_unique (assignment_id, student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A4698DB2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groups_students (student_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_1F7B776DCB944F1A (student_id), INDEX IDX_1F7B776DFE54D947 (group_id), PRIMARY KEY(student_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assignments (id INT AUTO_INCREMENT NOT NULL, subject_id INT DEFAULT NULL, lecture_type_id INT DEFAULT NULL, assignment_event_id INT DEFAULT NULL, weight INT NOT NULL, name VARCHAR(255) NOT NULL, deadline DATE DEFAULT NULL, INDEX IDX_308A50DD23EDC87 (subject_id), INDEX IDX_308A50DDF308DFC7 (lecture_type_id), UNIQUE INDEX UNIQ_308A50DDB5F59C7E (assignment_event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rooms (id INT AUTO_INCREMENT NOT NULL, building_id INT DEFAULT NULL, no VARCHAR(255) NOT NULL, INDEX IDX_7CA11A964D2A7E12 (building_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subjects (id INT AUTO_INCREMENT NOT NULL, lecturer_id INT NOT NULL, subjectType VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_AB259917BA2D8762 (lecturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecture_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecturers (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_84A5E4FFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groups (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assignment_events (id INT AUTO_INCREMENT NOT NULL, room_id INT NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, INDEX IDX_6BA6775754177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA35E32FCD FOREIGN KEY (lecture_id) REFERENCES lectures (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAF675F31B FOREIGN KEY (author_id) REFERENCES lecturers (id)');
        $this->addSql('ALTER TABLE seen_posts_students ADD CONSTRAINT FK_E9258CFA4B89032C FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seen_posts_students ADD CONSTRAINT FK_E9258CFACB944F1A FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecture_dates ADD CONSTRAINT FK_191CF035E32FCD FOREIGN KEY (lecture_id) REFERENCES lectures (id)');
        $this->addSql('ALTER TABLE lectures ADD CONSTRAINT FK_63C861D023EDC87 FOREIGN KEY (subject_id) REFERENCES subjects (id)');
        $this->addSql('ALTER TABLE lectures ADD CONSTRAINT FK_63C861D0BA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturers (id)');
        $this->addSql('ALTER TABLE lectures ADD CONSTRAINT FK_63C861D0FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id)');
        $this->addSql('ALTER TABLE lectures ADD CONSTRAINT FK_63C861D054177093 FOREIGN KEY (room_id) REFERENCES rooms (id)');
        $this->addSql('ALTER TABLE lectures ADD CONSTRAINT FK_63C861D0F308DFC7 FOREIGN KEY (lecture_type_id) REFERENCES lecture_type (id)');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE36110D19302F8 FOREIGN KEY (assignment_id) REFERENCES assignments (id)');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE36110CB944F1A FOREIGN KEY (student_id) REFERENCES students (id)');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB2A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE groups_students ADD CONSTRAINT FK_1F7B776DCB944F1A FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groups_students ADD CONSTRAINT FK_1F7B776DFE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE assignments ADD CONSTRAINT FK_308A50DD23EDC87 FOREIGN KEY (subject_id) REFERENCES subjects (id)');
        $this->addSql('ALTER TABLE assignments ADD CONSTRAINT FK_308A50DDF308DFC7 FOREIGN KEY (lecture_type_id) REFERENCES lecture_type (id)');
        $this->addSql('ALTER TABLE assignments ADD CONSTRAINT FK_308A50DDB5F59C7E FOREIGN KEY (assignment_event_id) REFERENCES assignment_events (id)');
        $this->addSql('ALTER TABLE rooms ADD CONSTRAINT FK_7CA11A964D2A7E12 FOREIGN KEY (building_id) REFERENCES buildings (id)');
        $this->addSql('ALTER TABLE subjects ADD CONSTRAINT FK_AB259917BA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturers (id)');
        $this->addSql('ALTER TABLE lecturers ADD CONSTRAINT FK_84A5E4FFA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE assignment_events ADD CONSTRAINT FK_6BA6775754177093 FOREIGN KEY (room_id) REFERENCES rooms (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rooms DROP FOREIGN KEY FK_7CA11A964D2A7E12');
        $this->addSql('ALTER TABLE seen_posts_students DROP FOREIGN KEY FK_E9258CFA4B89032C');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA35E32FCD');
        $this->addSql('ALTER TABLE lecture_dates DROP FOREIGN KEY FK_191CF035E32FCD');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB2A76ED395');
        $this->addSql('ALTER TABLE lecturers DROP FOREIGN KEY FK_84A5E4FFA76ED395');
        $this->addSql('ALTER TABLE seen_posts_students DROP FOREIGN KEY FK_E9258CFACB944F1A');
        $this->addSql('ALTER TABLE grades DROP FOREIGN KEY FK_3AE36110CB944F1A');
        $this->addSql('ALTER TABLE groups_students DROP FOREIGN KEY FK_1F7B776DCB944F1A');
        $this->addSql('ALTER TABLE grades DROP FOREIGN KEY FK_3AE36110D19302F8');
        $this->addSql('ALTER TABLE lectures DROP FOREIGN KEY FK_63C861D054177093');
        $this->addSql('ALTER TABLE assignment_events DROP FOREIGN KEY FK_6BA6775754177093');
        $this->addSql('ALTER TABLE lectures DROP FOREIGN KEY FK_63C861D023EDC87');
        $this->addSql('ALTER TABLE assignments DROP FOREIGN KEY FK_308A50DD23EDC87');
        $this->addSql('ALTER TABLE lectures DROP FOREIGN KEY FK_63C861D0F308DFC7');
        $this->addSql('ALTER TABLE assignments DROP FOREIGN KEY FK_308A50DDF308DFC7');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAF675F31B');
        $this->addSql('ALTER TABLE lectures DROP FOREIGN KEY FK_63C861D0BA2D8762');
        $this->addSql('ALTER TABLE subjects DROP FOREIGN KEY FK_AB259917BA2D8762');
        $this->addSql('ALTER TABLE lectures DROP FOREIGN KEY FK_63C861D0FE54D947');
        $this->addSql('ALTER TABLE groups_students DROP FOREIGN KEY FK_1F7B776DFE54D947');
        $this->addSql('ALTER TABLE assignments DROP FOREIGN KEY FK_308A50DDB5F59C7E');
        $this->addSql('DROP TABLE buildings');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE seen_posts_students');
        $this->addSql('DROP TABLE lecture_dates');
        $this->addSql('DROP TABLE lectures');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE grades');
        $this->addSql('DROP TABLE students');
        $this->addSql('DROP TABLE groups_students');
        $this->addSql('DROP TABLE assignments');
        $this->addSql('DROP TABLE rooms');
        $this->addSql('DROP TABLE subjects');
        $this->addSql('DROP TABLE lecture_type');
        $this->addSql('DROP TABLE lecturers');
        $this->addSql('DROP TABLE groups');
        $this->addSql('DROP TABLE assignment_events');
    }
}
