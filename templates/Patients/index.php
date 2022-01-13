<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient[]|\Cake\Collection\CollectionInterface $patients
 */
?>
<div class="three_quarter index content">
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('age') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('phone') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?= $this->Number->format($patient->id) ?></td>
                    <td><?= h($patient->name) ?></td>
                    <td><?= $this->Number->format($patient->age) ?></td>
                    <td><?= h($patient->email) ?></td>
                    <td><?= h($patient->phone) ?></td>
                    <td><?= h($patient->created_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $patient->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $patient->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $patient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patient->id)]) ?>
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
