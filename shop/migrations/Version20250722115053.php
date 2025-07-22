<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250722115053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL COMMENT \'ID каталожного номера\', brand_id INT DEFAULT NULL COMMENT \'ID бренда\', article VARCHAR(100) NOT NULL COMMENT \'Оригинальный каталожный номер\', article_search VARCHAR(100) NOT NULL COMMENT \'Каталожный номер для поиска (нормализованный)\', UNIQUE INDEX UNIQ_23A0E6623A0E66 (article), UNIQUE INDEX UNIQ_23A0E66DE374C27 (article_search), INDEX IDX_23A0E6644F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute (id INT AUTO_INCREMENT NOT NULL COMMENT \'ID атрибута\', name VARCHAR(255) NOT NULL COMMENT \'Название атрибута\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_tree (id INT AUTO_INCREMENT NOT NULL COMMENT \'ID узла дерева атрибутов\', parent_id INT DEFAULT NULL COMMENT \'ID узла дерева атрибутов\', name VARCHAR(255) NOT NULL COMMENT \'Название узла атрибутов\', INDEX IDX_ECD6FA54727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_tree_closure (ancestor_id INT NOT NULL COMMENT \'ID узла дерева атрибутов\', descendant_id INT NOT NULL COMMENT \'ID узла дерева атрибутов\', depth INT NOT NULL COMMENT \'Глубина пути от предка к потомку\', INDEX IDX_46E21EBC671CEA1 (ancestor_id), INDEX IDX_46E21EB1844467D (descendant_id), PRIMARY KEY(ancestor_id, descendant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL COMMENT \'ID бренда\', alias VARCHAR(50) NOT NULL COMMENT \'Краткое название бренда\', name VARCHAR(150) NOT NULL COMMENT \'Название бренда\', country VARCHAR(50) NOT NULL COMMENT \'Страна бренда\', town VARCHAR(50) NOT NULL COMMENT \'Город бренда\', UNIQUE INDEX UNIQ_1C52F958E16C6B94 (alias), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_name (id INT AUTO_INCREMENT NOT NULL COMMENT \'ID детали\', name VARCHAR(255) NOT NULL COMMENT \'Название детали\', name_search VARCHAR(255) NOT NULL COMMENT \'Название для поиска\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doc (id INT AUTO_INCREMENT NOT NULL COMMENT \'ID каталога\', picture_id INT DEFAULT NULL COMMENT \'ID картинки\', name VARCHAR(255) NOT NULL COMMENT \'Название каталога\', models VARCHAR(255) DEFAULT NULL COMMENT \'Модели в каталоге\', year INT DEFAULT NULL COMMENT \'Год каталога\', INDEX IDX_8641FD64EE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_picture (id INT AUTO_INCREMENT NOT NULL COMMENT \'Идентификатор группы картинок\', picture_id INT DEFAULT NULL COMMENT \'ID картинки\', name VARCHAR(150) NOT NULL COMMENT \'Название группы картинок\', INDEX IDX_90DB1B85EE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_tree (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_9E6405AC727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_tree_closure (ancestor_id INT NOT NULL, descendant_id INT NOT NULL, depth INT NOT NULL, INDEX IDX_6EC665F5C671CEA1 (ancestor_id), INDEX IDX_6EC665F51844467D (descendant_id), PRIMARY KEY(ancestor_id, descendant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE layout (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE layout_module (id INT AUTO_INCREMENT NOT NULL, layout_id INT NOT NULL, module VARCHAR(32) NOT NULL, position VARCHAR(32) NOT NULL, sort_order INT NOT NULL, INDEX IDX_771C31EE8C22AA1A (layout_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE layout_route (id INT AUTO_INCREMENT NOT NULL, layout_id INT NOT NULL, route VARCHAR(255) NOT NULL, INDEX IDX_8BF848B38C22AA1A (layout_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mark (id INT AUTO_INCREMENT NOT NULL COMMENT \'ID марки\', picture_id INT DEFAULT NULL COMMENT \'ID картинки\', alias VARCHAR(50) NOT NULL COMMENT \'Краткое название марки\', name VARCHAR(150) NOT NULL COMMENT \'Название марки\', UNIQUE INDEX UNIQ_6674F271E16C6B94 (alias), INDEX IDX_6674F271EE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_link (id INT AUTO_INCREMENT NOT NULL, model_type_id INT NOT NULL COMMENT \'ID типа модели\', mark_id INT NOT NULL COMMENT \'ID марки\', doc_id INT DEFAULT NULL COMMENT \'ID каталога\', INDEX IDX_1BFBB516A5DFE562 (model_type_id), INDEX IDX_1BFBB5164290F12B (mark_id), INDEX IDX_1BFBB516895648BC (doc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_type (id INT AUTO_INCREMENT NOT NULL COMMENT \'ID типа модели\', picture_id INT DEFAULT NULL COMMENT \'ID картинки\', name VARCHAR(100) NOT NULL COMMENT \'Название типа модели\', INDEX IDX_A1897BCEEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL COMMENT \'ID картинки\', path VARCHAR(255) NOT NULL COMMENT \'Путь к файлу картинки\', alt VARCHAR(255) DEFAULT NULL COMMENT \'Атрибут alt для картинки\', title VARCHAR(255) DEFAULT NULL COMMENT \'Атрибут title для картинки\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6644F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE attribute_tree ADD CONSTRAINT FK_ECD6FA54727ACA70 FOREIGN KEY (parent_id) REFERENCES attribute_tree (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE attribute_tree_closure ADD CONSTRAINT FK_46E21EBC671CEA1 FOREIGN KEY (ancestor_id) REFERENCES attribute_tree (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attribute_tree_closure ADD CONSTRAINT FK_46E21EB1844467D FOREIGN KEY (descendant_id) REFERENCES attribute_tree (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE doc ADD CONSTRAINT FK_8641FD64EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE group_picture ADD CONSTRAINT FK_90DB1B85EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE group_tree ADD CONSTRAINT FK_9E6405AC727ACA70 FOREIGN KEY (parent_id) REFERENCES group_tree (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE group_tree_closure ADD CONSTRAINT FK_6EC665F5C671CEA1 FOREIGN KEY (ancestor_id) REFERENCES group_tree (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_tree_closure ADD CONSTRAINT FK_6EC665F51844467D FOREIGN KEY (descendant_id) REFERENCES group_tree (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE layout_module ADD CONSTRAINT FK_771C31EE8C22AA1A FOREIGN KEY (layout_id) REFERENCES layout (id)');
        $this->addSql('ALTER TABLE layout_route ADD CONSTRAINT FK_8BF848B38C22AA1A FOREIGN KEY (layout_id) REFERENCES layout (id)');
        $this->addSql('ALTER TABLE mark ADD CONSTRAINT FK_6674F271EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE model_link ADD CONSTRAINT FK_1BFBB516A5DFE562 FOREIGN KEY (model_type_id) REFERENCES model_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_link ADD CONSTRAINT FK_1BFBB5164290F12B FOREIGN KEY (mark_id) REFERENCES mark (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_link ADD CONSTRAINT FK_1BFBB516895648BC FOREIGN KEY (doc_id) REFERENCES doc (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE model_type ADD CONSTRAINT FK_A1897BCEEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6644F5D008');
        $this->addSql('ALTER TABLE attribute_tree DROP FOREIGN KEY FK_ECD6FA54727ACA70');
        $this->addSql('ALTER TABLE attribute_tree_closure DROP FOREIGN KEY FK_46E21EBC671CEA1');
        $this->addSql('ALTER TABLE attribute_tree_closure DROP FOREIGN KEY FK_46E21EB1844467D');
        $this->addSql('ALTER TABLE doc DROP FOREIGN KEY FK_8641FD64EE45BDBF');
        $this->addSql('ALTER TABLE group_picture DROP FOREIGN KEY FK_90DB1B85EE45BDBF');
        $this->addSql('ALTER TABLE group_tree DROP FOREIGN KEY FK_9E6405AC727ACA70');
        $this->addSql('ALTER TABLE group_tree_closure DROP FOREIGN KEY FK_6EC665F5C671CEA1');
        $this->addSql('ALTER TABLE group_tree_closure DROP FOREIGN KEY FK_6EC665F51844467D');
        $this->addSql('ALTER TABLE layout_module DROP FOREIGN KEY FK_771C31EE8C22AA1A');
        $this->addSql('ALTER TABLE layout_route DROP FOREIGN KEY FK_8BF848B38C22AA1A');
        $this->addSql('ALTER TABLE mark DROP FOREIGN KEY FK_6674F271EE45BDBF');
        $this->addSql('ALTER TABLE model_link DROP FOREIGN KEY FK_1BFBB516A5DFE562');
        $this->addSql('ALTER TABLE model_link DROP FOREIGN KEY FK_1BFBB5164290F12B');
        $this->addSql('ALTER TABLE model_link DROP FOREIGN KEY FK_1BFBB516895648BC');
        $this->addSql('ALTER TABLE model_type DROP FOREIGN KEY FK_A1897BCEEE45BDBF');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE attribute');
        $this->addSql('DROP TABLE attribute_tree');
        $this->addSql('DROP TABLE attribute_tree_closure');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE detail_name');
        $this->addSql('DROP TABLE doc');
        $this->addSql('DROP TABLE group_picture');
        $this->addSql('DROP TABLE group_tree');
        $this->addSql('DROP TABLE group_tree_closure');
        $this->addSql('DROP TABLE layout');
        $this->addSql('DROP TABLE layout_module');
        $this->addSql('DROP TABLE layout_route');
        $this->addSql('DROP TABLE mark');
        $this->addSql('DROP TABLE model_link');
        $this->addSql('DROP TABLE model_type');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
