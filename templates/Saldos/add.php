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
            <?= $this->Html->link(__('List Saldos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="saldos form content">
            <?= $this->Form->create($saldo) ?>
            <fieldset>
                <legend><?= __('Add Saldo') ?></legend>
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
