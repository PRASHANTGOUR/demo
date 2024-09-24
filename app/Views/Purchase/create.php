<?php 
# Call in main template
echo $this->extend('layouts/default');

# Meta title Section 
echo $this->section('heading');
echo $title; // Display the page title
echo $this->endSection();

echo $this->section('sidebar'); 
echo $this->endSection();

# Main Content
echo $this->section('content'); 
$this->db = db_connect();
?>
<!--begin::Post-->
<div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div class="container-xxl">
        <div class="row justify-content-center">
            <form action="<?= url_to('PurchaseController::store'); ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Supplier ID -->
                <div class="form-group">
                    <label for="supplier_id" class="col-form-label-sm">Supplier ID</label>
                    <input type="number" class="form-control form-control-sm" name="supplier_id" id="supplier_id" value="<?= set_value('supplier_id') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('supplier_id')): ?>
                        <div class="text-danger"><?= $validation->getError('supplier_id') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Item ID -->
                <div class="form-group">
                    <label for="item_id" class="col-form-label-sm">Item ID</label>
                    <input type="number" class="form-control form-control-sm" name="item_id" id="item_id" value="<?= set_value('item_id') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('item_id')): ?>
                        <div class="text-danger"><?= $validation->getError('item_id') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Category ID -->
                <div class="form-group">
                    <label for="category_id" class="col-form-label-sm">Category ID</label>
                    <input type="number" class="form-control form-control-sm" name="category_id" id="category_id" value="<?= set_value('category_id') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('category_id')): ?>
                        <div class="text-danger"><?= $validation->getError('category_id') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Purchase Date -->
                <div class="form-group">
                    <label for="purchase_date" class="col-form-label-sm">Purchase Date</label>
                    <input type="date" class="form-control form-control-sm" name="purchase_date" id="purchase_date" value="<?= set_value('purchase_date') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('purchase_date')): ?>
                        <div class="text-danger"><?= $validation->getError('purchase_date') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Total Amount -->
                <div class="form-group">
                    <label for="total_amount" class="col-form-label-sm">Total Amount</label>
                    <input type="number" step="0.01" class="form-control form-control-sm" name="total_amount" id="total_amount" value="<?= set_value('total_amount') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('total_amount')): ?>
                        <div class="text-danger"><?= $validation->getError('total_amount') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status" class="col-form-label-sm">Status</label>
                    <select class="form-control form-control-sm" name="status" id="status">
                        <option value="pending" <?= set_select('status', 'pending', true); ?>>Pending</option>
                        <option value="completed" <?= set_select('status', 'completed'); ?>>Completed</option>
                        <option value="canceled" <?= set_select('status', 'canceled'); ?>>Canceled</option>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('status')): ?>
                        <div class="text-danger"><?= $validation->getError('status') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Payment Status -->
                <div class="form-group">
                    <label for="payment_status" class="col-form-label-sm">Payment Status</label>
                    <select class="form-control form-control-sm" name="payment_status" id="payment_status">
                        <option value="unpaid" <?= set_select('payment_status', 'unpaid', true); ?>>Unpaid</option>
                        <option value="paid" <?= set_select('payment_status', 'paid'); ?>>Paid</option>
                        <option value="partial" <?= set_select('payment_status', 'partial'); ?>>Partial</option>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('payment_status')): ?>
                        <div class="text-danger"><?= $validation->getError('payment_status') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Notes -->
                <div class="form-group">
                    <label for="notes" class="col-form-label-sm">Notes</label>
                    <textarea class="form-control form-control-sm" name="notes" id="notes"><?= set_value('notes') ?></textarea>
                </div>

                <!-- Submit Button -->
                <button id="saveButton" type="submit" class="btn btn-sm btn-primary bg-gradient-primary btn-icon-split mt-4 float-right rounded-0 form-control-sm">
                    <span class="icon text-white">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text">Add Purchase</span>
                </button>
            </form>
        </div>
    </div>
</div>
<!--end::Container-->
</div>
<!--end::Post-->

<?php 
echo $this->endSection();
?>
