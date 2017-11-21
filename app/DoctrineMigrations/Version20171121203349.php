<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171121203349 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE seen_posts_students (student_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_E9258CFACB944F1A (student_id), INDEX IDX_E9258CFA4B89032C (post_id), PRIMARY KEY(student_id, post_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE seen_posts_students ADD CONSTRAINT FK_E9258CFACB944F1A FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seen_posts_students ADD CONSTRAINT FK_E9258CFA4B89032C FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE seen_posts_students');
    }
}
