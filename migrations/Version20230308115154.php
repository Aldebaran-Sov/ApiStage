<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308115154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE internship (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_student_id INTEGER NOT NULL, id_company_id INTEGER NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, CONSTRAINT FK_10D1B00C6E1ECFCD FOREIGN KEY (id_student_id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_10D1B00C32119A01 FOREIGN KEY (id_company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_10D1B00C6E1ECFCD ON internship (id_student_id)');
        $this->addSql('CREATE INDEX IDX_10D1B00C32119A01 ON internship (id_company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE internship');
    }
}
