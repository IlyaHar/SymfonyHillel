<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240623055303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shortener ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shortener ADD CONSTRAINT FK_F35FE890A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F35FE890A76ED395 ON shortener (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shortener DROP FOREIGN KEY FK_F35FE890A76ED395');
        $this->addSql('DROP INDEX IDX_F35FE890A76ED395 ON shortener');
        $this->addSql('ALTER TABLE shortener DROP user_id');
    }
}
