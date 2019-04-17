<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190107124847 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contenucommande DROP FOREIGN KEY FK_D2D18AF07294869C');
        $this->addSql('DROP INDEX UNIQ_D2D18AF07294869C ON contenucommande');
        $this->addSql('ALTER TABLE contenucommande DROP article_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contenucommande ADD article_id INT NOT NULL');
        $this->addSql('ALTER TABLE contenucommande ADD CONSTRAINT FK_D2D18AF07294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D2D18AF07294869C ON contenucommande (article_id)');
    }
}
