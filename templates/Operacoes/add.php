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
            <?= $this->Html->link(__('List Operacoes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="operacoes form content">
            <?= $this->Form->create($operaco) ?>
            <fieldset>
                <legend><?= __('Add Operaco') ?></legend>
                <?php
                    echo $this->Form->control('operacao');
                    echo $this->Form->control('descricao');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
