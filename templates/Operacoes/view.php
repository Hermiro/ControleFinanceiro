<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Operaco $operaco
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Operaco'), ['action' => 'edit', $operaco->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Operaco'), ['action' => 'delete', $operaco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $operaco->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Operacoes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Operaco'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="operacoes view content">
            <h3><?= h($operaco->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Operacao') ?></th>
                    <td><?= h($operaco->operacao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Descricao') ?></th>
                    <td><?= h($operaco->descricao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($operaco->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
