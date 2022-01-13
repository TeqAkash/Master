<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient $patient
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            
        </div>
    </aside>
    <div class="column-responsive column-50">
        <div class="one_half form content">
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('Add Patient') ?></legend>
                <?php
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    //echo $this->Form->control('created_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('login')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
