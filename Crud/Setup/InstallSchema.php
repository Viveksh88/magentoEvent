<?php
namespace Excellence\Crud\Setup;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        //START: install stuff
        //END:   install stuff
        
        //START table setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable('excellence_crud_operation')
        )->addColumn(
            'excellence_crud_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true, ],
            'Entity ID'
        )->addColumn(
            'username',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'UserName'
        )->addColumn(
            'fristname',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'FirstName'
        )->addColumn(
            'lastname',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'LastName'
        )->addColumn(
            'email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'Email'
        )->addColumn(
            'password',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
             [],
            [ 'nullable' => false, ],
            'Password'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT, ],
            'Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE, ],
            'Modification Time'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'nullable' => false, 'default' => '1', ],
            'Is Active'
        );
        $installer->getConnection()->createTable($table);//$table end here
        $tableB = $installer->getConnection()->newTable(
            $installer->getTable('excellence_crud_orderSuccessDetails')
        )->addColumn(
            'excellence_crud_orderId',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true, ],
            'Entity ID'
        )->addColumn(
            'grandTotal',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'totalAmount'
        )->addColumn(
            'customerId',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            255,
            [ 'nullable' => false, ],
            'CustomerId'
        )->addColumn(
            'customerEmail',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'customerEmail'
        )->addColumn(
            'customerFirstname',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'customerfName'
        )->addColumn(
            'customerLastname',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
             [],
            [ 'nullable' => false, ],
            'customerLname'
        )->addColumn(
            'currencyCode',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
             [],
            [ 'nullable' => false, ],
            'currencyCode'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT, ],
            'Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE, ],
            'Modification Time'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'nullable' => false, 'default' => '1', ],
            'Is Active'
        );
        
        $installer->getConnection()->createTable($tableB);//$tableB end here

        $table_A = $installer->getConnection()->newTable(//$table_A starts
            $installer->getTable('excellence_crud_address')
        )->addColumn(
            'excellence_address_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true, ],
            'Entity ID'
        )->addColumn(
            'excellence_user_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            255,
            [ 'nullable' => false, ],
            'User ID'
        )->addColumn(
            'House_no',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'House_number'
        )->addColumn(
            'Street_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'Street'
        )->addColumn(
            'City_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'City'
        )->addColumn(
            'State_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'State'
        )->addColumn(
            'pin',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            255,
            [ 'nullable' => false, ],
            'pin'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT, ],
            'Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE, ],
            'Modification Time'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'nullable' => false, 'default' => '1', ],
            'Is Active'
        );
        $installer->getConnection()->createTable($table_A);//$table_A ends
$installer->endSetup();
    }
}
