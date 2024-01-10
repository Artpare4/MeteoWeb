<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110164611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, rue VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asso_adresse_user (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, adresse_id INT NOT NULL, INDEX IDX_2ED0C4A5A76ED395 (user_id), INDEX IDX_2ED0C4A54DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asso_adresse_user ADD CONSTRAINT FK_2ED0C4A5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE asso_adresse_user ADD CONSTRAINT FK_2ED0C4A54DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asso_adresse_user DROP FOREIGN KEY FK_2ED0C4A5A76ED395');
        $this->addSql('ALTER TABLE asso_adresse_user DROP FOREIGN KEY FK_2ED0C4A54DE7DC5C');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE asso_adresse_user');
    }
}
