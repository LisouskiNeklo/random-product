<?php

namespace Neklo\RandomProduct\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 */
class InstallSchema implements InstallSchemaInterface
{
    const TABLE_NAME_RANDOM_PRODUCT = 'neklo_random_product';

    const TABLE_NAME_CATALOG_PRODUCT = 'catalog_product_entity';

    /**
     * {@inheritdoc}
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $this->createRandomProductTable($setup);

        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     * @return void
     * @throws \Zend_Db_Exception
     */
    private function createRandomProductTable($setup)
    {
        $table = $setup->getConnection()->newTable(
            $setup->getTable(self::TABLE_NAME_RANDOM_PRODUCT)
        )->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'product_id',
            Table::TYPE_INTEGER,
            10,
            ['unsigned' => true, 'nullable' => false],
            'Product ID'
        )->addForeignKey(
            $setup->getFkName(self::TABLE_NAME_RANDOM_PRODUCT,
                'product_id',
                self::TABLE_NAME_CATALOG_PRODUCT,
                'entity_id'),
            'product_id',
            $setup->getTable(self::TABLE_NAME_CATALOG_PRODUCT),
            'entity_id',
            Table::ACTION_CASCADE
        )->setComment(
            'Random Product Table'
        );

        $setup->getConnection()->createTable($table);
    }
}