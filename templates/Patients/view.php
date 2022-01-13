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
    <div class="column-responsive column-80">
        <div class="one_half view content">
            <h3><?= h($patient->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($patient->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($patient->email) ?></td>
                </tr>
                
                <tr>
                    <th><?= __('Age') ?></th>
                    <td><?= $this->Number->format($patient->age) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($patient->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($patient->created_date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Address') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($patient->address)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Appoints') ?></h4>
                <?php if (!empty($patient->appoints)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                     
                            <th><?= __('Appoint Date') ?></th>
                            
                            
                        </tr>
                        <?php foreach ($patient->appoints as $appoints) : ?>
                        <tr>
                           
                            <td><?= h($appoints->appoint_date) ?></td>
                            
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
