<?php 
# Call in main template
echo $this->extend('layouts/default');

# Meta title Section 
echo $this->section('heading');
// echo $title;
echo $this->endSection();

echo $this->section('sidebar'); 

echo $this->endSection();

# Main Content
echo $this->section('content'); 
?>
 <?php if (session()->getFlashdata('success')): ?>
        <div>
            <p><?= session()->getFlashdata('success') ?></p>
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
											<a href="index.html" class="text-muted text-hover-primary">Home</a>
										</li>
										<li class="breadcrumb-item text-muted">Stock Movements</li>
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
								<!--begin::Products-->
								<div class="card card-flush">
									<!--begin::Card header-->
									<div class="card-header align-items-center py-5 gap-2 gap-md-5">
										<!--begin::Card title-->
										<div class="card-title">
										<div class="">
											<form method="get" action="">
													
													<input type="text" name="search" value="<?= esc($search) ?>" class="form-control form-control-solid w-250px" placeholder="Search Product" />
													<button type="submit" class="btn position-absolute" style="left:200px; top:27px" ><i class="fas fa-search"></i></button>
													
												</form>
												</div>
											<!--begin::Search-->
											<!-- <div class="d-flex align-items-center position-relative my-1"> -->
												<!-- <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
													<span class="path1"></span>
													<span class="path2"></span>
												</i> -->
												
											<!-- </div> -->
											<!--end::Search-->
										</div>
										<!--end::Card title-->
										<!--begin::Card toolbar-->
										<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
											<div class="w-100 mw-150px">
												<!--begin::Select2-->
												<!--<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-product-filter="status">
													<option></option>
													<option value="all">All</option>
													<option value="published">Published</option>
													<option value="scheduled">Scheduled</option>
													<option value="inactive">Inactive</option>
												</select> -->
												<!--end::Select2-->
											</div>
											<!--begin::Add product-->
											<a href="<?= url_to('StockMovementController::create');?>" class="btn btn-primary">Add Stock</a>
											<!--end::Add product-->
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
													<th class="min-w-50px">Item Id</th>
													<th class="min-w-100px">Movement Type</th>
													<th class="min-w-70px">Quantity</th>
													<th class="min-w-70px">Movemen Date</th>
													<th class="min-w-70px">Status</th>
													<th class="min-w-70px">Actions</th>
												</tr>
											</thead>
											<tbody class="fw-semibold text-gray-600">
                                            <?php if (!empty($stockMovements) && is_array($stockMovements)): ?>
                                            <?php foreach ($stockMovements as $movement): ?>
                                                <tr>
                                                    <td><?= $movement['item_id'] ?></td>
                                                    <td><?= $movement['movement_type'] ?></td>
                                                    <td><?= $movement['quantity'] ?></td>
                                                    <td><?= $movement['movement_date'] ?></td>
                                                    <td><?= $movement['status'] ?></td>
                                                    <td class="">
														<a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
														<i class="ki-duotone ki-down fs-5 ms-1"></i></a>
														<!--begin::Menu-->
														<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
															<!--begin::Menu item-->
															<div class="menu-item px-3">
																<a href="<?= url_to('StockMovementController::edit', $movement['id']) ?>" class="menu-link px-3">Edit</a>
															</div>
															<!--end::Menu item-->
															<!--begin::Menu item-->
															<div class="menu-item px-3">
                                                            <form action="<?= url_to('StockMovementController::delete', $movement['id']) ?>" method="post">
                                                                <input type="hidden" name="_method" value="DELETE"> <!-- To simulate DELETE request -->
                                                                <button type="submit" class="menu-link px-3" style="background: none; border: none; color: inherit;">Delete</button>
                                                            </form>
															</div>
															<!--end::Menu item-->
														</div>
														<!--end::Menu-->
													</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6">No stock movements found.</td>
                                            </tr>
                                        <?php endif; ?>
											
											</tbody>
										</table>
										<!--end::Table-->
										 
											</div>
									<!--end::Card body-->
									<div class="d-flex justify-content-center">
                                 
									</div>
								</div>
								<!--end::Products-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->

<?php 
echo $this->endSection();