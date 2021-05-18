<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210517192418 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conciertos (id INT AUTO_INCREMENT NOT NULL, id_promotor_id INT NOT NULL, id_recinto_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, numero_espectadores INT NOT NULL, fecha DATE NOT NULL, rentabilidad INT DEFAULT NULL, INDEX IDX_E231245B19266720 (id_promotor_id), INDEX IDX_E231245B26EB04D3 (id_recinto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, cache INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupos_conciertos (id INT AUTO_INCREMENT NOT NULL, id_concierto_id INT NOT NULL, id_grupo_id INT NOT NULL, INDEX IDX_8D40A240C8E32FD9 (id_concierto_id), INDEX IDX_8D40A240CC58DC96 (id_grupo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupos_medios (id INT AUTO_INCREMENT NOT NULL, id_medio_id INT NOT NULL, id_concierto_id INT NOT NULL, INDEX IDX_84B29C325A9B46D3 (id_medio_id), INDEX IDX_84B29C32C8E32FD9 (id_concierto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medios (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotores (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recintos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, coste_alquiler INT NOT NULL, precio_entrada INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conciertos ADD CONSTRAINT FK_E231245B19266720 FOREIGN KEY (id_promotor_id) REFERENCES promotores (id)');
        $this->addSql('ALTER TABLE conciertos ADD CONSTRAINT FK_E231245B26EB04D3 FOREIGN KEY (id_recinto_id) REFERENCES recintos (id)');
        $this->addSql('ALTER TABLE grupos_conciertos ADD CONSTRAINT FK_8D40A240C8E32FD9 FOREIGN KEY (id_concierto_id) REFERENCES conciertos (id)');
        $this->addSql('ALTER TABLE grupos_conciertos ADD CONSTRAINT FK_8D40A240CC58DC96 FOREIGN KEY (id_grupo_id) REFERENCES grupos (id)');
        $this->addSql('ALTER TABLE grupos_medios ADD CONSTRAINT FK_84B29C325A9B46D3 FOREIGN KEY (id_medio_id) REFERENCES medios (id)');
        $this->addSql('ALTER TABLE grupos_medios ADD CONSTRAINT FK_84B29C32C8E32FD9 FOREIGN KEY (id_concierto_id) REFERENCES conciertos (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grupos_conciertos DROP FOREIGN KEY FK_8D40A240C8E32FD9');
        $this->addSql('ALTER TABLE grupos_medios DROP FOREIGN KEY FK_84B29C32C8E32FD9');
        $this->addSql('ALTER TABLE grupos_conciertos DROP FOREIGN KEY FK_8D40A240CC58DC96');
        $this->addSql('ALTER TABLE grupos_medios DROP FOREIGN KEY FK_84B29C325A9B46D3');
        $this->addSql('ALTER TABLE conciertos DROP FOREIGN KEY FK_E231245B19266720');
        $this->addSql('ALTER TABLE conciertos DROP FOREIGN KEY FK_E231245B26EB04D3');
        $this->addSql('DROP TABLE conciertos');
        $this->addSql('DROP TABLE grupos');
        $this->addSql('DROP TABLE grupos_conciertos');
        $this->addSql('DROP TABLE grupos_medios');
        $this->addSql('DROP TABLE medios');
        $this->addSql('DROP TABLE promotores');
        $this->addSql('DROP TABLE recintos');
    }
}
