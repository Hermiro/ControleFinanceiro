<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SaldosFixture
 */
class SaldosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Chave primária da tabela.', 'autoIncrement' => true, 'precision' => null],
        'id_pessoa' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Chave estrangeira da pessoa. ', 'precision' => null, 'autoIncrement' => null],
        'total_value' => ['type' => 'float', 'length' => 11, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Valor atual (saldo) do cliente.
'],
        '_indexes' => [
            'PessoaID_idx' => ['type' => 'index', 'columns' => ['id_pessoa'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'id_UNIQUE' => ['type' => 'unique', 'columns' => ['id'], 'length' => []],
            'PessoaID' => ['type' => 'foreign', 'columns' => ['id_pessoa'], 'references' => ['pessoas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'id_pessoa' => 1,
                'total_value' => 1,
            ],
        ];
        parent::init();
    }
}
