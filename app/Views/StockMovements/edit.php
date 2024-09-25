<?php 
echo $this->extend('layouts/default');
echo $this->section('heading');
echo $this->endSection();
echo $this->section('sidebar'); 
echo $this->endSection();
echo $this->section('content'); 
?>
<!--begin::Post-->
<div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
    <div class="container-xxl">
        <div class="row justify-content-center">
            <form action="<?= url_to('StockMovementController::update', $stockMovement['id']); ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Item ID -->
                <div class="form-group">
                    <label for="item_id" class="col-form-label-sm">Item ID</label>
                    <input type="number" class="form-control form-control-sm" name="item_id" id="item_id" value="<?= set_value('item_id', $stockMovement['item_id']) ?>" required>
                    <?php if (isset($validation) && $validation->hasError('item_id')): ?>
                        <div class="text-danger"><?= $validation->getError('item_id') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Movement Type -->
                <div class="form-group">
                    <label for="movement_type" class="col-form-label-sm">Movement Type</label>
                    <select class="form-control form-control-sm" name="movement_type" id="movement_type" required>
                        <option value="">Select Movement Type</option>
                        <option value="in" <?= set_select('movement_type', 'in', $stockMovement['movement_type'] == 'in') ?>>In</option>
                        <option value="out" <?= set_select('movement_type', 'out', $stockMovement['movement_type'] == 'out') ?>>Out</option>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('movement_type')): ?>
                        <div class="text-danger"><?= $validation->getError('movement_type') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Quantity -->
                <div class="form-group">
                    <label for="quantity" class="col-form-label-sm">Quantity</label>
                    <input type="number" class="form-control form-control-sm" name="quantity" id="quantity" value="<?= set_value('quantity', $stockMovement['quantity']) ?>" required>
                    <?php if (isset($validation) && $validation->hasError('quantity')): ?>
                        <div class="text-danger"><?= $validation->getError('quantity') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Movement Date -->
                <div class="form-group">
                    <label for="movement_date" class="col-form-label-sm">Movement Date</label>
                    <input type="date" class="form-control form-control-sm" name="movement_date" id="movement_date" value="<?= set_value('movement_date', $stockMovement['movement_date']) ?>" required>
                    <?php if (isset($validation) && $validation->hasError('movement_date')): ?>
                        <div class="text-danger"><?= $validation->getError('movement_date') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status" class="col-form-label-sm">Status</label>
                    <select class="form-control form-control-sm" name="status" id="status" required>
                        <option value="">Select Status</option>
                        <option value="active" <?= set_select('status', 'active', $stockMovement['status'] == 'active') ?>>Active</option>
                        <option value="inactive" <?= set_select('status', 'inactive', $stockMovement['status'] == 'inactive') ?>>Inactive</option>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('status')): ?>
                        <div class="text-danger"><?= $validation->getError('status') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Submit Button -->
                <button id="saveButton" type="submit" class="btn btn-sm btn-primary bg-gradient-primary btn-icon-split mt-4 float-right rounded-0 form-control-sm">
                    <span class="icon text-white">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Update</span>
                </button>
            </form>
        </div>
    </div>
</div>
<!--end::Post-->
<?php 
echo $this->endSection();
?>
