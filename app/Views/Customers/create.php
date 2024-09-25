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
            <form action="<?= url_to('CustomerController::store'); ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Customer Name -->
                <div class="form-group">
                    <label for="customer_name" class="col-form-label-sm">Customer Name</label>
                    <input type="text" class="form-control form-control-sm" name="customer_name" id="customer_name" value="<?= set_value('customer_name') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('customer_name')): ?>
                        <div class="text-danger"><?= $validation->getError('customer_name') ?></div>
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

                <!-- Status -->
                <div class="form-group">
                    <label for="status" class="col-form-label-sm">Status</label>
                    <select class="form-control form-control-sm" name="status" id="status" required>
                        <option value="active" <?= set_select('status', 'active') ?>>Active</option>
                        <option value="inactive" <?= set_select('status', 'inactive') ?>>Inactive</option>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('status')): ?>
                        <div class="text-danger"><?= $validation->getError('status') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Submit Button -->
                <button id="saveButton" type="submit" class="btn btn-sm btn-primary bg-gradient-primary btn-icon-split mt-4 float-right rounded-0 form-control-sm">
                    <span class="icon text-white">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text">Add Customer</span>
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
