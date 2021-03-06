<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190107130901 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE contenucommande_article');
        $this->addSql('ALTER TABLE contenucommande ADD article_id INT NOT NULL, ADD quantite INT NOT NULL');
        $this->addSql('ALTER TABLE contenucommande ADD CONSTRAINT FK_D2D18AF07294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_D2D18AF07294869C ON contenucommande (article_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contenucommande_article (contenucommande_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_8F28AD5EE33D24B1 (contenucommande_id), INDEX IDX_8F28AD5E7294869C (article_id), PRIMARY KEY(contenucommande_id, article_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contenucommande_article ADD CONSTRAINT FK_8F28AD5E7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contenucommande_article ADD CONSTRAINT FK_8F28AD5EE33D24B1 FOREIGN KEY (contenucommande_id) REFERENCES contenucommande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contenucommande DROP FOREIGN KEY FK_D2D18AF07294869C');
        $this->addSql('DROP INDEX IDX_D2D18AF07294869C ON contenucommande');
        $this->addSql('ALTER TABLE contenucommande DROP article_id, DROP quantite');
    }
}
