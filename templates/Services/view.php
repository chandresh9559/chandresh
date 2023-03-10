<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Service $service
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Service'), ['action' => 'edit', $service->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Service'), ['action' => 'delete', $service->id], ['confirm' => __('Are you sure you want to delete # {0}?', $service->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Services'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Service'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="services view content">
            <h3><?= h($service->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Service') ?></th>
                    <td><?= h($service->service) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($service->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($service->created) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Owner Services') ?></h4>
                <?php if (!empty($service->owner_services)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Project Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Service Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($service->owner_services as $ownerServices) : ?>
                        <tr>
                            <td><?= h($ownerServices->id) ?></td>
                            <td><?= h($ownerServices->project_id) ?></td>
                            <td><?= h($ownerServices->user_id) ?></td>
                            <td><?= h($ownerServices->service_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OwnerServices', 'action' => 'view', $ownerServices->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OwnerServices', 'action' => 'edit', $ownerServices->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'OwnerServices', 'action' => 'delete', $ownerServices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ownerServices->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related User Services') ?></h4>
                <?php if (!empty($service->user_services)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Service Id') ?></th>
                            <th><?= __('Created Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($service->user_services as $userServices) : ?>
                        <tr>
                            <td><?= h($userServices->id) ?></td>
                            <td><?= h($userServices->user_id) ?></td>
                            <td><?= h($userServices->service_id) ?></td>
                            <td><?= h($userServices->created_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'UserServices', 'action' => 'view', $userServices->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'UserServices', 'action' => 'edit', $userServices->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserServices', 'action' => 'delete', $userServices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userServices->id)]) ?>
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
