<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211008185734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7E00EE68D');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7F5A26FD9');
        $this->addSql('DROP INDEX IDX_BA388B7E00EE68D ON cart');
        $this->addSql('DROP INDEX UNIQ_BA388B7F5A26FD9 ON cart');
        $this->addSql('ALTER TABLE cart ADD member_id INT NOT NULL, ADD product_id INT NOT NULL, DROP id_product_id, DROP id_member_id');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B77597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B77597D3FE ON cart (member_id)');
        $this->addSql('CREATE INDEX IDX_BA388B74584665A ON cart (product_id)');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F46DD4481AD');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F46E00EE68D');
        $this->addSql('DROP INDEX IDX_ED896F46E00EE68D ON order_detail');
        $this->addSql('DROP INDEX IDX_ED896F46DD4481AD ON order_detail');
        $this->addSql('ALTER TABLE order_detail ADD product_id INT NOT NULL, ADD order_paid_id INT NOT NULL, DROP id_order_id, DROP id_product_id');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F464584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F46FDB013AB FOREIGN KEY (order_paid_id) REFERENCES order_paid (id)');
        $this->addSql('CREATE INDEX IDX_ED896F464584665A ON order_detail (product_id)');
        $this->addSql('CREATE INDEX IDX_ED896F46FDB013AB ON order_detail (order_paid_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B77597D3FE');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74584665A');
        $this->addSql('DROP INDEX UNIQ_BA388B77597D3FE ON cart');
        $this->addSql('DROP INDEX IDX_BA388B74584665A ON cart');
        $this->addSql('ALTER TABLE cart ADD id_product_id INT NOT NULL, ADD id_member_id INT NOT NULL, DROP member_id, DROP product_id');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7E00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7F5A26FD9 FOREIGN KEY (id_member_id) REFERENCES member (id)');
        $this->addSql('CREATE INDEX IDX_BA388B7E00EE68D ON cart (id_product_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B7F5A26FD9 ON cart (id_member_id)');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F464584665A');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F46FDB013AB');
        $this->addSql('DROP INDEX IDX_ED896F464584665A ON order_detail');
        $this->addSql('DROP INDEX IDX_ED896F46FDB013AB ON order_detail');
        $this->addSql('ALTER TABLE order_detail ADD id_order_id INT NOT NULL, ADD id_product_id INT NOT NULL, DROP product_id, DROP order_paid_id');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F46DD4481AD FOREIGN KEY (id_order_id) REFERENCES order_paid (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F46E00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_ED896F46E00EE68D ON order_detail (id_product_id)');
        $this->addSql('CREATE INDEX IDX_ED896F46DD4481AD ON order_detail (id_order_id)');
    }
}
