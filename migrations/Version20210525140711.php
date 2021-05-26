<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525140711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention ADD pieces_de_rechange_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814ABD3392C8B FOREIGN KEY (pieces_de_rechange_id) REFERENCES pieces_de_rechange (id)');
        $this->addSql('CREATE INDEX IDX_D11814ABD3392C8B ON intervention (pieces_de_rechange_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814ABD3392C8B');
        $this->addSql('DROP INDEX IDX_D11814ABD3392C8B ON intervention');
        $this->addSql('ALTER TABLE intervention DROP pieces_de_rechange_id');
    }
}
