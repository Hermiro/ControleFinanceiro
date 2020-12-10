<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Operaco[]|\Cake\Collection\CollectionInterface $operacoes
 */
?>
<div class="operacoes index content">
    <?= $this->Html->link(__('New Operaco'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Operacoes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('operacao') ?></th>
                    <th><?= $this->Paginator->sort('descricao') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($operacoes as $operaco): ?>
                <tr>
                    <td><?= $this->Number->format($operaco->id) ?></td>
                    <td><?= h($operaco->operacao) ?></td>
                    <td><?= h($operaco->descricao) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $operaco->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $operaco->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $operaco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $operaco->id)]) ?>
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
