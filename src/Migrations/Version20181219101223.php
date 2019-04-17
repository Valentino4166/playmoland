<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181219101223 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, nom_client_id INT NOT NULL, INDEX IDX_24CC0DF28D1A1860 (nom_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF28D1A1860 FOREIGN KEY (nom_client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ligne_panier ADD n_panier_id INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_panier ADD CONSTRAINT FK_21691B4304E57C5 FOREIGN KEY (n_panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_21691B4304E57C5 ON ligne_panier (n_panier_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_panier DROP FOREIGN KEY FK_21691B4304E57C5');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP INDEX IDX_21691B4304E57C5 ON ligne_panier');
        $this->addSql('ALTER TABLE ligne_panier DROP n_panier_id');
    }
}
