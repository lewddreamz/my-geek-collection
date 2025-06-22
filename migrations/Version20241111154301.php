<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241111154301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE messenger_messages_id_seq CASCADE');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('SELECT setval(\'book_id_seq\', (SELECT MAX(id) FROM book))');
        $this->addSql('ALTER TABLE book ALTER id SET DEFAULT nextval(\'book_id_seq\')');
        $this->addSql('SELECT setval(\'collection_id_seq\', (SELECT MAX(id) FROM collection))');
        $this->addSql('ALTER TABLE collection ALTER id SET DEFAULT nextval(\'collection_id_seq\')');
        $this->addSql('SELECT setval(\'entry_id_seq\', (SELECT MAX(id) FROM entry))');
        $this->addSql('ALTER TABLE entry ALTER id SET DEFAULT nextval(\'entry_id_seq\')');
        $this->addSql('SELECT setval(\'film_id_seq\', (SELECT MAX(id) FROM film))');
        $this->addSql('ALTER TABLE film ALTER id SET DEFAULT nextval(\'film_id_seq\')');
        $this->addSql('SELECT setval(\'game_id_seq\', (SELECT MAX(id) FROM game))');
        $this->addSql('ALTER TABLE game ALTER id SET DEFAULT nextval(\'game_id_seq\')');
        $this->addSql('SELECT setval(\'user_id_seq\', (SELECT MAX(id) FROM "user"))');
        $this->addSql('ALTER TABLE "user" ALTER id SET DEFAULT nextval(\'user_id_seq\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE messenger_messages_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_75ea56e016ba31db ON messenger_messages (delivered_at)');
        $this->addSql('CREATE INDEX idx_75ea56e0e3bd61ce ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX idx_75ea56e0fb7336f0 ON messenger_messages (queue_name)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE entry ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE book ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE film ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE game ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE collection ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER id DROP DEFAULT');
    }
}
