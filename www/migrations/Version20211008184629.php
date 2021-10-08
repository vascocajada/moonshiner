<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211008184629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, id_product_id INT NOT NULL, id_member_id INT NOT NULL, INDEX IDX_BA388B7E00EE68D (id_product_id), UNIQUE INDEX UNIQ_BA388B7F5A26FD9 (id_member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_detail (id INT AUTO_INCREMENT NOT NULL, id_order_id INT NOT NULL, id_product_id INT NOT NULL, INDEX IDX_ED896F46DD4481AD (id_order_id), INDEX IDX_ED896F46E00EE68D (id_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_paid (id INT AUTO_INCREMENT NOT NULL, id_member INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7E00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7F5A26FD9 FOREIGN KEY (id_member_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F46DD4481AD FOREIGN KEY (id_order_id) REFERENCES order_paid (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F46E00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F46DD4481AD');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE order_detail');
        $this->addSql('DROP TABLE order_paid');
    }
}
