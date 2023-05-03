<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230401214244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `annonces` (id_annonce INT AUTO_INCREMENT NOT NULL, id_colis_id INT DEFAULT NULL, type VARCHAR(20) NOT NULL, ville_dep VARCHAR(20) NOT NULL, ville_arr VARCHAR(20) NOT NULL, date_dep VARCHAR(20) NOT NULL, date_arr VARCHAR(20) NOT NULL, prix INT NOT NULL, description VARCHAR(100) NOT NULL, ida_U INT NOT NULL, INDEX IDX_CB988C6F8973C782 (ida_U), INDEX IDX_CB988C6F1DFD61E5 (id_colis_id), PRIMARY KEY(id_annonce)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `colis` (id INT AUTO_INCREMENT NOT NULL, id_u  INT NOT NULL, nomExpediteur VARCHAR(50) NOT NULL, adresseExpediteur VARCHAR(50) NOT NULL, nomDestinataire VARCHAR(50) NOT NULL, adresseDestinataire VARCHAR(50) NOT NULL, poids DOUBLE PRECISION NOT NULL, statut VARCHAR(30) NOT NULL, dateExpedition DATE NOT NULL, INDEX IDX_470BDFF9E8824683 (id_u ), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idu (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, cin VARCHAR(255) NOT NULL, dateNaissance DATE NOT NULL, dateCreationC DATE NOT NULL, status TINYINT(1) NOT NULL, role VARCHAR(255) NOT NULL, motPass VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, score VARCHAR(8) NOT NULL, numtel VARCHAR(11) NOT NULL, image VARCHAR(255) NOT NULL, compte_ex DATETIME DEFAULT NULL, token_ex DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `validation` (id INT AUTO_INCREMENT NOT NULL, idu INT NOT NULL, imageA VARCHAR(255) NOT NULL, imageB VARCHAR(255) NOT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_16AC5B6E99B902AD (idu), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `vehicule` (idv INT AUTO_INCREMENT NOT NULL, type VARCHAR(30) NOT NULL, immat VARCHAR(30) NOT NULL, etat TINYINT(1) NOT NULL, kilometrage VARCHAR(30) NOT NULL, chevaux INT NOT NULL, marque VARCHAR(30) NOT NULL, modele VARCHAR(30) NOT NULL, couleur VARCHAR(15) NOT NULL, prix DOUBLE PRECISION NOT NULL, img VARCHAR(150) NOT NULL, PRIMARY KEY(idv)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `annonces` ADD CONSTRAINT FK_CB988C6F8973C782 FOREIGN KEY (ida_U) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `annonces` ADD CONSTRAINT FK_CB988C6F1DFD61E5 FOREIGN KEY (id_colis_id) REFERENCES `colis` (id)');
        $this->addSql('ALTER TABLE `colis` ADD CONSTRAINT FK_470BDFF9E8824683 FOREIGN KEY (id_u ) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `validation` ADD CONSTRAINT FK_16AC5B6E99B902AD FOREIGN KEY (idu) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `annonces` DROP FOREIGN KEY FK_CB988C6F8973C782');
        $this->addSql('ALTER TABLE `annonces` DROP FOREIGN KEY FK_CB988C6F1DFD61E5');
        $this->addSql('ALTER TABLE `colis` DROP FOREIGN KEY FK_470BDFF9E8824683');
        $this->addSql('ALTER TABLE `validation` DROP FOREIGN KEY FK_16AC5B6E99B902AD');
        $this->addSql('DROP TABLE `annonces`');
        $this->addSql('DROP TABLE `colis`');
        $this->addSql('DROP TABLE idu');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE `validation`');
        $this->addSql('DROP TABLE `vehicule`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
