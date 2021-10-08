<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211008233614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74584665A');
        $this->addSql('DROP INDEX IDX_BA388B74584665A ON cart');
        $this->addSql('ALTER TABLE cart ADD id_product INT NOT NULL, CHANGE product_id id_member INT NOT NULL');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F464584665A');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F46FDB013AB');
        $this->addSql('DROP INDEX IDX_ED896F46FDB013AB ON order_detail');
        $this->addSql('DROP INDEX IDX_ED896F464584665A ON order_detail');
        $this->addSql('ALTER TABLE order_detail ADD id_order INT NOT NULL, ADD id_product INT NOT NULL, DROP product_id, DROP order_paid_id');
        $this->addSql('ALTER TABLE order_paid ADD member_id INT NOT NULL, DROP total');
        $this->addSql('ALTER TABLE order_paid ADD CONSTRAINT FK_B07F912F7597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('CREATE INDEX IDX_B07F912F7597D3FE ON order_paid (member_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart ADD product_id INT NOT NULL, DROP id_member, DROP id_product');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_BA388B74584665A ON cart (product_id)');
        $this->addSql('ALTER TABLE order_detail ADD product_id INT NOT NULL, ADD order_paid_id INT NOT NULL, DROP id_order, DROP id_product');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F464584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F46FDB013AB FOREIGN KEY (order_paid_id) REFERENCES order_paid (id)');
        $this->addSql('CREATE INDEX IDX_ED896F46FDB013AB ON order_detail (order_paid_id)');
        $this->addSql('CREATE INDEX IDX_ED896F464584665A ON order_detail (product_id)');
        $this->addSql('ALTER TABLE order_paid DROP FOREIGN KEY FK_B07F912F7597D3FE');
        $this->addSql('DROP INDEX IDX_B07F912F7597D3FE ON order_paid');
        $this->addSql('ALTER TABLE order_paid ADD total NUMERIC(5, 2) NOT NULL, DROP member_id');
    }
}
