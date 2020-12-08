<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pessoa $pessoa
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Pessoa'), ['action' => 'edit', $pessoa->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Pessoa'), ['action' => 'delete', $pessoa->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pessoa->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Pessoas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Pessoa'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="pessoas view content">
            <h3><?= h($pessoa->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td><?= h($pessoa->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sobrenome') ?></th>
                    <td><?= h($pessoa->sobrenome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($pessoa->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Historicos') ?></h4>
                <?php if (!empty($pessoa->historicos)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Pessoa Id') ?></th>
                            <th><?= __('Operacao Id') ?></th>
                            <th><?= __('Valor') ?></th>
                            <th><?= __('Valor Anterior') ?></th>
                            <th><?= __('Valor Final') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($pessoa->historicos as $historicos) : ?>
                        <tr>
                            <td><?= h($historicos->id) ?></td>
                            <td><?= h($historicos->pessoa_id) ?></td>
                            <td><?= h($historicos->operacao_id) ?></td>
                            <td><?= h($historicos->valor) ?></td>
                            <td><?= h($historicos->valor_anterior) ?></td>
                            <td><?= h($historicos->valor_final) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Historicos', 'action' => 'view', $historicos->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Historicos', 'action' => 'edit', $historicos->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Historicos', 'action' => 'delete', $historicos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $historicos->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
