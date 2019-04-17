<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181219103436 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_panier DROP FOREIGN KEY FK_21691B4FAB7A1D');
        $this->addSql('DROP INDEX UNIQ_21691B4FAB7A1D ON ligne_panier');
        $this->addSql('ALTER TABLE ligne_panier ADD lignes_panier_id INT DEFAULT NULL, DROP article_ligne_id');
        $this->addSql('ALTER TABLE ligne_panier ADD CONSTRAINT FK_21691B4D5CBC06C FOREIGN KEY (lignes_panier_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_21691B4D5CBC06C ON ligne_panier (lignes_panier_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_panier DROP FOREIGN KEY FK_21691B4D5CBC06C');
        $this->addSql('DROP INDEX IDX_21691B4D5CBC06C ON ligne_panier');
        $this->addSql('ALTER TABLE ligne_panier ADD article_ligne_id INT NOT NULL, DROP lignes_panier_id');
        $this->addSql('ALTER TABLE ligne_panier ADD CONSTRAINT FK_21691B4FAB7A1D FOREIGN KEY (article_ligne_id) REFERENCES article (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21691B4FAB7A1D ON ligne_panier (article_ligne_id)');
    }
}
