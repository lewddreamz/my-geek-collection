<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241106140043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE book_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE collection_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE entry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE film_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE book (id INT NOT NULL, title VARCHAR(255) NOT NULL, genre TEXT NOT NULL, created_at DATE NOT NULL, author VARCHAR(255) NOT NULL, pages_amount SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN book.genre IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN book.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE collection (id INT NOT NULL, parent_id INT DEFAULT NULL, name TEXT NOT NULL, type TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FC4D6532727ACA70 ON collection (parent_id)');
        $this->addSql('CREATE TABLE entry (id INT NOT NULL, collection_id INT DEFAULT NULL, film_id INT DEFAULT NULL, game_id INT DEFAULT NULL, book_id INT DEFAULT NULL, entry_type VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2B219D70514956FD ON entry (collection_id)');
        $this->addSql('CREATE INDEX IDX_2B219D70567F5183 ON entry (film_id)');
        $this->addSql('CREATE INDEX IDX_2B219D70E48FD905 ON entry (game_id)');
        $this->addSql('CREATE INDEX IDX_2B219D7016A2B381 ON entry (book_id)');
        $this->addSql('COMMENT ON COLUMN entry.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE film (id INT NOT NULL, title VARCHAR(255) NOT NULL, genre TEXT NOT NULL, created_at DATE NOT NULL, author VARCHAR(255) NOT NULL, string VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN film.genre IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN film.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, title VARCHAR(255) NOT NULL, genre TEXT NOT NULL, created_at DATE NOT NULL, author VARCHAR(255) NOT NULL, publisher VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN game.genre IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN game.created_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D6532727ACA70 FOREIGN KEY (parent_id) REFERENCES collection (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D70514956FD FOREIGN KEY (collection_id) REFERENCES collection (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D70567F5183 FOREIGN KEY (film_id) REFERENCES film (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D70E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D7016A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE book_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE collection_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE entry_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE film_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('ALTER TABLE collection DROP CONSTRAINT FK_FC4D6532727ACA70');
        $this->addSql('ALTER TABLE entry DROP CONSTRAINT FK_2B219D70514956FD');
        $this->addSql('ALTER TABLE entry DROP CONSTRAINT FK_2B219D70567F5183');
        $this->addSql('ALTER TABLE entry DROP CONSTRAINT FK_2B219D70E48FD905');
        $this->addSql('ALTER TABLE entry DROP CONSTRAINT FK_2B219D7016A2B381');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE collection');
        $this->addSql('DROP TABLE entry');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
