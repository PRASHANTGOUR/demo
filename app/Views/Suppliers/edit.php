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
            <form action="<?= url_to('SupplierController::update', $supplier['supplier_id']); ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Supplier Name -->
                <div class="form-group">
                    <label for="supplier_name" class="col-form-label-sm">Supplier Name</label>
                    <input type="text" class="form-control form-control-sm" name="supplier_name" id="supplier_name" value="<?= set_value('supplier_name', $supplier['supplier_name']) ?>" required>
                    <?php if (isset($validation) && $validation->hasError('supplier_name')): ?>
                        <div class="text-danger"><?= $validation->getError('supplier_name') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Contact Name -->
                <div class="form-group">
                    <label for="contact_name" class="col-form-label-sm">Contact Name</label>
                    <input type="text" class="form-control form-control-sm" name="contact_name" id="contact_name" value="<?= set_value('contact_name', $supplier['contact_name']) ?>" required>
                    <?php if (isset($validation) && $validation->hasError('contact_name')): ?>
                        <div class="text-danger"><?= $validation->getError('contact_name') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Contact Phone -->
                <div class="form-group">
                    <label for="contact_phone" class="col-form-label-sm">Contact Phone</label>
                    <input type="text" class="form-control form-control-sm" name="contact_phone" id="contact_phone" value="<?= set_value('contact_phone', $supplier['contact_phone']) ?>" required>
                    <?php if (isset($validation) && $validation->hasError('contact_phone')): ?>
                        <div class="text-danger"><?= $validation->getError('contact_phone') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address" class="col-form-label-sm">Address</label>
                    <textarea class="form-control form-control-sm" name="address" id="address"><?= set_value('address', $supplier['address']) ?></textarea>
                    <?php if (isset($validation) && $validation->hasError('address')): ?>
                        <div class="text-danger"><?= $validation->getError('address') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="col-form-label-sm">Email</label>
                    <input type="email" class="form-control form-control-sm" name="email" id="email" value="<?= set_value('email', $supplier['email']) ?>" required>
                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                        <div class="text-danger"><?= $validation->getError('email') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Submit Button -->
                <button id="saveButton" type="submit" class="btn btn-sm btn-primary bg-gradient-primary btn-icon-split mt-4 float-right rounded-0 form-control-sm">
                    <span class="icon text-white">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Update Supplier</span>
                </button>
            </form>
        </div>
    </div>
</div>
<!--end::Post-->
<?php 
echo $this->endSection();
?>
