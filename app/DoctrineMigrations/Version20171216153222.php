<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171216153222 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE assignments DROP FOREIGN KEY FK_308A50DDF308DFC7');
        $this->addSql('ALTER TABLE lectures DROP FOREIGN KEY FK_63C861D0F308DFC7');
        $this->addSql('DROP TABLE lecture_type');
        $this->addSql('DROP INDEX IDX_63C861D0F308DFC7 ON lectures');
        $this->addSql('ALTER TABLE lectures ADD lecture_type VARCHAR(255) NOT NULL, DROP lecture_type_id');
        $this->addSql('DROP INDEX IDX_308A50DDF308DFC7 ON assignments');
        $this->addSql('ALTER TABLE assignments ADD lecture_type VARCHAR(255) NOT NULL, DROP lecture_type_id');
        $this->addSql('ALTER TABLE groups ADD number INT NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lecture_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assignments ADD lecture_type_id INT DEFAULT NULL, DROP lecture_type');
        $this->addSql('ALTER TABLE assignments ADD CONSTRAINT FK_308A50DDF308DFC7 FOREIGN KEY (lecture_type_id) REFERENCES lecture_type (id)');
        $this->addSql('CREATE INDEX IDX_308A50DDF308DFC7 ON assignments (lecture_type_id)');
        $this->addSql('ALTER TABLE groups DROP number');
        $this->addSql('ALTER TABLE lectures ADD lecture_type_id INT DEFAULT NULL, DROP lecture_type');
        $this->addSql('ALTER TABLE lectures ADD CONSTRAINT FK_63C861D0F308DFC7 FOREIGN KEY (lecture_type_id) REFERENCES lecture_type (id)');
        $this->addSql('CREATE INDEX IDX_63C861D0F308DFC7 ON lectures (lecture_type_id)');
    }
}
