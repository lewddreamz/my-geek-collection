<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250519191343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entry DROP CONSTRAINT fk_2b219d7016a2b381');
        $this->addSql('ALTER TABLE entry DROP CONSTRAINT fk_2b219d70567f5183');
        $this->addSql('ALTER TABLE entry DROP CONSTRAINT fk_2b219d70e48fd905');
        $this->addSql('DROP SEQUENCE book_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE film_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP INDEX idx_2b219d7016a2b381');
        $this->addSql('DROP INDEX idx_2b219d70e48fd905');
        $this->addSql('DROP INDEX idx_2b219d70567f5183');
        $this->addSql('ALTER TABLE entry ADD metadata JSONB NOT NULL');
        $this->addSql('ALTER TABLE entry DROP film_id');
        $this->addSql('ALTER TABLE entry DROP game_id');
        $this->addSql('ALTER TABLE entry DROP book_id');
        $this->addSql('ALTER TABLE entry DROP discr');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE book_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE film_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE book (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, genre TEXT NOT NULL, created_at DATE NOT NULL, author VARCHAR(255) NOT NULL, pages_amount SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN book.genre IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN book.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE film (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, genre TEXT NOT NULL, created_at DATE NOT NULL, author VARCHAR(255) NOT NULL, string VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN film.genre IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN film.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE game (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, genre TEXT NOT NULL, created_at DATE NOT NULL, author VARCHAR(255) NOT NULL, publisher VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN game.genre IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN game.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE entry ADD film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entry ADD game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entry ADD book_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entry ADD discr VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE entry DROP metadata');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT fk_2b219d70567f5183 FOREIGN KEY (film_id) REFERENCES film (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT fk_2b219d70e48fd905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT fk_2b219d7016a2b381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2b219d7016a2b381 ON entry (book_id)');
        $this->addSql('CREATE INDEX idx_2b219d70e48fd905 ON entry (game_id)');
        $this->addSql('CREATE INDEX idx_2b219d70567f5183 ON entry (film_id)');
    }
}
