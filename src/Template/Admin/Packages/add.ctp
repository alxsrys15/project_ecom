<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<style type="text/css">
    .required {
        color: red;
    }
</style>
<?= $this->Form->create() ?>
<div class="row">
    <div class="col-sm-6">
        <div class="col-sm-12">
            <label for="name" class="col-form-label">Name <span class="required">*</span></label>
            <?= $this->Form->control('name', ['class'=> 'form-control', 'label' => false, 'required' => true]) ?>
        </div>
        <div class="col-sm-12">
            <label for="description" class="col-form-label">Description</label>
            <?= $this->Form->control('description', ['class'=> 'form-control', 'label' => false, 'required' => true, 'type' => 'textarea']) ?>
        </div>
        <div class="col-sm-12">
            <label for="qty" class="col-form-label">Activation code count <span class="required">*</span></label>
            <?= $this->Form->control('qty', ['class'=> 'form-control', 'label' => false, 'required' => true, 'type' => 'number', 'default' => '1']) ?>
        </div>
        <div class="col-sm-12">
            <label for="price" class="col-form-label">Price <span class="required">*</span></label>
            <?= $this->Form->control('price', ['class'=> 'form-control', 'label' => false, 'required' => true, 'type' => 'number', 'default' => '1']) ?>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-primary" type="submit">Add Package</button>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>


