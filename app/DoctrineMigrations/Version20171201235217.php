<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171201235217 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA23EDC87');
        $this->addSql('DROP INDEX IDX_885DBAFA23EDC87 ON posts');
        $this->addSql('ALTER TABLE posts CHANGE subject_id lecture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA35E32FCD FOREIGN KEY (lecture_id) REFERENCES lectures (id)');
        $this->addSql('CREATE INDEX IDX_885DBAFA35E32FCD ON posts (lecture_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA35E32FCD');
        $this->addSql('DROP INDEX IDX_885DBAFA35E32FCD ON posts');
        $this->addSql('ALTER TABLE posts CHANGE lecture_id subject_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA23EDC87 FOREIGN KEY (subject_id) REFERENCES subjects (id)');
        $this->addSql('CREATE INDEX IDX_885DBAFA23EDC87 ON posts (subject_id)');
    }
}
