<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211203094306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE divecenter_inmersiones (divecenter_id INT NOT NULL, inmersiones_id INT NOT NULL, INDEX IDX_B11A66F3EAA7108E (divecenter_id), INDEX IDX_B11A66F39A3520B2 (inmersiones_id), PRIMARY KEY(divecenter_id, inmersiones_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE divecenter_inmersiones ADD CONSTRAINT FK_B11A66F3EAA7108E FOREIGN KEY (divecenter_id) REFERENCES divecenter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE divecenter_inmersiones ADD CONSTRAINT FK_B11A66F39A3520B2 FOREIGN KEY (inmersiones_id) REFERENCES inmersiones (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD evento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64987A5F842 FOREIGN KEY (evento_id) REFERENCES inmersiones (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64987A5F842 ON user (evento_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE divecenter_inmersiones');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64987A5F842');
        $this->addSql('DROP INDEX IDX_8D93D64987A5F842 ON user');
        $this->addSql('ALTER TABLE user DROP evento_id');
    }
}
