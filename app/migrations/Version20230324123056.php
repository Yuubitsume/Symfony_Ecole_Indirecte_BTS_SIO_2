<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324123056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_controle (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, matiere_id INT DEFAULT NULL, note DOUBLE PRECISION DEFAULT NULL, coefficient INT NOT NULL, INDEX IDX_1E62E5F0A76ED395 (user_id), INDEX IDX_1E62E5F0F46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, surname VARCHAR(50) NOT NULL, mail VARCHAR(100) NOT NULL, pseudo VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, classe_name VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498F5EA509 ON user (classe_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note_controle ADD CONSTRAINT FK_1E62E5F0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE note_controle ADD CONSTRAINT FK_1E62E5F0F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');


        $this->addSql("INSERT INTO `matiere` (`id`, `libelle`) VALUES
        (1, 'DEV'), (2, 'MATH'), (3, 'SVT'), (4, 'Anglais'), (5, 'Base de données'), (6, 'CEJM')");

        $this->addSql("INSERT INTO `classes` (`id`, `classe_name`) VALUES
        (1, 'A'), (2, 'B'), (3, 'Z')");

        $this->addSql("INSERT INTO `user` (`id`, `username`, `roles`, `password`, `surname`, `mail`, `pseudo`, `classe_id` ) VALUES
        (1, 'julien', '[\"ROLE_ADMIN\"]', '\$2y\$13\$yQsaBLZ/uMhxdZ4LNMFofOhIOYdSdkY.KHaA8sY6ELjbsE5v.oV3q', 'perez', 'admin@gmail.com', '', 1),
        (2, 'patrick', '[\"ROLE_ADMIN\"]', '\$2y\$13\$t6X74m9xmMZV3ZODf0EnRuxZb2LD/vbOnXghNfV6SBq12hOtUwRn.', 'patrick', 'patrick@gmail.com', '', 2),
        (3, 'michel', '[]', '\$2y\$13\$XyD73Eq6lxzgNbYF.pKEPeT/02Cp5NcmGmiNi2PXZmOcuRN.T3fYq', 'dupont', 'michel@gmail.com', '', 2),
        (4, 'Xavier', '[]', '\$2y\$13\$HH..7/gZMtEe..JQgfB9H.pnsGvGQ4PhABCW9GVWhz363dIk7OtTe', 'plaitil', 'xavier.plaitil@gmail.com', '', 2),
        (5, 'Albert', '[]', '\$2y\$13\$EUP8JCX0jh4H1K4X0WujPuRLI9QgTlmvdo/J22pMbRwYrWujlIzrO', 'Simon', 'Albert.Simon@gmail.com', '', 1),
        (6, 'Vigile', '[]', '\$2y\$13\$d36LXahJsQeOiCLDzMULuefHjYYjHgoMFWdTNkzy6u.m86ZVfEWGq', 'class', 'vigile.class@gmail.com', '', 2),
        (7, 'Flick', '[]', '\$2y\$13\$F8.a9HOeEkwym18m.Oo2ducENoQfz3svRN6VQ8wmUKujdEhlxUJsO', 'Rl', 'flick.RL@gmail.com', '', 2),
        (8, 'oui', '[]', '\$2y\$13\$Sp4e/Hyq0nd/haa2Lz5JkeadJWeA2fEkzdav5msLCjnAAKi5iryQi', 'non', 'michel2@gmail.com', '', 1),
        (9, 'Lizard', '[]', '\$2y\$13\$ibdWua5TRbnC3taeIucp6OUIMZjxG6xVvfqCEzhhqnUW6Jm9Q1gke', 'Fly', 'michel34@gmail.com', '', 2),
        (13, 'Lizard2', '[]', '\$2y\$13\$1iw5OcahdY0n0ihccPjRhuNxzYaWo6chjMn9EZ79siDG6Nf6y.lTW', 'gggg', 'michel88@gmail.com', 'lllll', 1),
        (14, 'oui4', '[]', '\$2y\$13\$89zVkNEvmdCx0R1MGgkLbu87Q//dxduCZHYkPjJH4L2kGzuZVrhya', 'hgdfhd', 'michel89@gmail.com', 'dfgdgffdh', 1),
        (15, 'yanis', '[]', '\$2y\$13\$s1AipgC4yXivxn13Akd6jOyBRdT2KjzBuRH2zqo/2LSv0yvknqge2', 'yanis2', 'yanis@gmail.com', 'yanis3', 1)");
        
        $this->addSql("INSERT INTO `note_controle` (`id`, `note`, `coefficient`, `user_id`, `matiere_id`) VALUES
        (1, 14, 2, 7, 6),
        (2, 17, 1, 5, 2),
        (3, 13, 1, 9, 5),
        (4, 19, 2, 4, 1),
        (5, 14, 3, 6, 2),
        (24, 12, 2, 5, 3)");
    
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_controle DROP FOREIGN KEY FK_1E62E5F0A76ED395');
        $this->addSql('ALTER TABLE note_controle DROP FOREIGN KEY FK_1E62E5F0F46CD258');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE note_controle');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498F5EA509');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP INDEX IDX_8D93D6498F5EA509 ON user');
        $this->addSql('ALTER TABLE user DROP classe_id');
    }
}
