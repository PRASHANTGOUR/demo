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
<!-- setup branch -->
<div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div class="container-xxl">
        <div class="row justify-content-center">
            <form action="<?= url_to('SupplierController::store'); ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Supplier Name -->
                <div class="form-group">
                    <label for="supplier_name" class="col-form-label-sm">Supplier Name</label>
                    <input type="text" class="form-control form-control-sm" name="supplier_name" id="supplier_name" value="<?= set_value('supplier_name') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('supplier_name')): ?>
                        <div class="text-danger"><?= $validation->getError('supplier_name') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Contact Name -->
                <div class="form-group">
                    <label for="contact_name" class="col-form-label-sm">Contact Name</label>
                    <input type="text" class="form-control form-control-sm" name="contact_name" id="contact_name" value="<?= set_value('contact_name') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('contact_name')): ?>
                        <div class="text-danger"><?= $validation->getError('contact_name') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Contact Phone -->
                <div class="form-group">
                    <label for="contact_phone" class="col-form-label-sm">Contact Phone</label>
                    <input type="text" class="form-control form-control-sm" name="contact_phone" id="contact_phone" value="<?= set_value('contact_phone') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('contact_phone')): ?>
                        <div class="text-danger"><?= $validation->getError('contact_phone') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address" class="col-form-label-sm">Address</label>
                    <textarea class="form-control form-control-sm" name="address" id="address"><?= set_value('address') ?></textarea>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="col-form-label-sm">Email</label>
                    <input type="email" class="form-control form-control-sm" name="email" id="email" value="<?= set_value('email') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                        <div class="text-danger"><?= $validation->getError('email') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Submit Button -->
                <button id="saveButton" type="submit" class="btn btn-sm btn-primary bg-gradient-primary btn-icon-split mt-4 float-right rounded-0 form-control-sm">
                    <span class="icon text-white">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text">Add Supplier</span>
                </button>
            </form>
        </div>
    </div>
</div>
<!--end::Container-->
</div>
<!--end::Post-->
</div>

<?php 
echo $this->endSection();
?>
