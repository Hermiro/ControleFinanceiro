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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $operaco->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $operaco->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Operacoes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="operacoes form content">
            <?= $this->Form->create($operaco) ?>
            <fieldset>
                <legend><?= __('Edit Operaco') ?></legend>
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
