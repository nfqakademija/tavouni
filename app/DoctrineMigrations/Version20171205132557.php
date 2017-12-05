<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171205132557 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE assignments ADD assignment_event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assignments ADD CONSTRAINT FK_308A50DDB5F59C7E FOREIGN KEY (assignment_event_id) REFERENCES assignment_events (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_308A50DDB5F59C7E ON assignments (assignment_event_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE assignments DROP FOREIGN KEY FK_308A50DDB5F59C7E');
        $this->addSql('DROP INDEX UNIQ_308A50DDB5F59C7E ON assignments');
        $this->addSql('ALTER TABLE assignments DROP assignment_event_id');
    }
}
