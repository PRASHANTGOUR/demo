<?php 
echo $this->extend('layouts/default');

echo $this->section('heading');
echo $this->endSection();

echo $this->section('sidebar'); 
echo $this->endSection();

echo $this->section('content'); 
?>
    <?php if (session()->getFlashdata('success')): ?>
        <div>
            <p><?= session()->getFlashdata('success') ?></p>
        </div>
    <?php endif; ?>

    <!--begin::Content-->
    <div class="content fs-6 d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
                <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="<?= base_url(); ?>" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item text-muted">Customers</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
            <div class="container-xxl">
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <form method="get" action="">
                                <input type="text" name="search" value="<?= esc($search) ?>" class="form-control form-control-solid w-250px" placeholder="Search Customer" />
                                <button type="submit" class="btn position-absolute" style="left:200px; top:27px"><i class="fas fa-search"></i></button>
                            </form>
                        </div>

                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <a href="<?= url_to('CustomerController::create'); ?>" class="btn btn-primary">Add Customer</a>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">Customer Name</th>
                                    <th class="min-w-100px">Contact Phone</th>
                                    <th class="min-w-100px">Email</th>
                                    <th class="min-w-70px">Address</th>
                                    <th class="min-w-70px">Status</th>
                                    <th class="min-w-70px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php if (!empty($customers)): ?>
                                    <?php foreach ($customers as $customer): ?>
                                        <tr>
                                            <td><?= esc($customer['customer_name']) ?></td>
                                            <td><?= esc($customer['contact_phone']) ?></td>
                                            <td><?= esc($customer['email']) ?></td>
                                            <td><?= esc($customer['address']) ?></td>
                                            <td><?= esc($customer['status']) ?></td>
                                            <td class="">
                                                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                </a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="<?= url_to('CustomerController::edit', $customer['customer_id']) ?>" class="menu-link px-3">Edit</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                    <form action="<?= url_to('CustomerController::delete', $customer['customer_id']) ?>" method="POST" style="display:inline-block;">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="btn btn-sm">Delete</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No customers found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center">
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
echo $this->endSection();
