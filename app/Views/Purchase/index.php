<?php 
# Call in main template
echo $this->extend('layouts/default');

# Meta title Section 
echo $this->section('heading');
echo $title;  // Display the title
echo $this->endSection();

echo $this->section('sidebar'); 
// You can add sidebar content here if necessary
echo $this->endSection();

# Main Content
echo $this->section('content'); 
?>
<?php if (session()->getFlashdata('success')): ?>
    <div>
        <p class="alert alert-success"><?= session()->getFlashdata('success') ?></p>
    </div>
<?php endif; ?>

<!--begin::Content-->
<div class="content fs-6 d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="<?= base_url() ?>" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Purchases</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Toolbar-->
    
    <!--begin::Post-->
    <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div class="container-xxl">
            <!--begin::Purchases-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <div class="">
                            <form method="get" action="">
                                <input type="text" name="search" value="<?= esc($search) ?>" class="form-control form-control-solid w-250px" placeholder="Search Purchase" />
                                <button type="submit" class="btn position-absolute" style="left:200px; top:27px"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!--end::Card title-->
                    
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="<?= url_to('PurchaseController::create');?>" class="btn btn-primary">Add Purchase</a>
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">													    
                                <th class="min-w-50px">Supplier ID</th>
                                <th class="min-w-100px">Item ID</th>
                                <th class="min-w-70px">Category ID</th>
                                <th class="min-w-70px">Purchase Date</th>
                                <th class="min-w-70px">Total Amount</th>
                                <th class="min-w-70px">Status</th>
                                <th class="min-w-70px">Payment Status</th>
                                <th class="min-w-70px">Notes</th>
                                <th class="min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        <?php if (!empty($purchases)): ?>
                            <?php foreach ($purchases as $purchase): ?>
                            <tr>
                                <td><?= esc($purchase['supplier_id']) ?></td>
                                <td><?= esc($purchase['item_id']) ?></td>
                                <td><?= esc($purchase['category_id']) ?></td>
                                <td><?= esc($purchase['purchase_date']) ?></td>
                                <td><?= esc($purchase['total_amount']) ?></td>
                                <td><?= esc($purchase['status']) ?></td>
                                <td><?= esc($purchase['payment_status']) ?></td>
                                <td><?= esc($purchase['notes']) ?></td>
                                <td>
                                    <a href="<?= url_to('PurchaseController::edit', $purchase['purchase_id']) ?>" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary">Edit</a>
                                    <form action="<?= url_to('PurchaseController::delete', $purchase['purchase_id']) ?>" method="POST" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm" style="background: none; border: none; color: inherit;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9">No purchases found.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Purchases-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->

<?php 
echo $this->endSection();
