<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Saldo[]|\Cake\Collection\CollectionInterface $saldos
 */
?>
<div class="saldos index content">
    <?= $this->Html->link(__('New Saldo'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Saldos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('id_pessoa') ?></th>
                    <th><?= $this->Paginator->sort('total_value') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($saldos as $saldo): ?>
                <tr>
                    <td><?= $this->Number->format($saldo->id) ?></td>
                    <td><?= $this->Number->format($saldo->id_pessoa) ?></td>
                    <td><?= $this->Number->format($saldo->total_value) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $saldo->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $saldo->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $saldo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saldo->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
