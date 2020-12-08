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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $saldo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $saldo->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Saldos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="saldos form content">
            <?= $this->Form->create($saldo) ?>
            <fieldset>
                <legend><?= __('Edit Saldo') ?></legend>
                <?php
                    echo $this->Form->control('id_pessoa');
                    echo $this->Form->control('total_value');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
