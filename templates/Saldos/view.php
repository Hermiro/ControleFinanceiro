<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Saldo $saldo
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Saldo'), ['action' => 'edit', $saldo->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Saldo'), ['action' => 'delete', $saldo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saldo->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Saldos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Saldo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="saldos view content">
            <h3><?= h($saldo->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($saldo->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id Pessoa') ?></th>
                    <td><?= $this->Number->format($saldo->id_pessoa) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Value') ?></th>
                    <td><?= $this->Number->format($saldo->total_value) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
