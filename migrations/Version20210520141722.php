<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210520141722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B09186A3C8B0');
        $this->addSql('DROP INDEX IDX_18D2B09186A3C8B0 ON materiel');
        $this->addSql('ALTER TABLE materiel DROP intervetion_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiel ADD intervetion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B09186A3C8B0 FOREIGN KEY (intervetion_id) REFERENCES intervetion (id)');
        $this->addSql('CREATE INDEX IDX_18D2B09186A3C8B0 ON materiel (intervetion_id)');
    }
}
