<?php Get::view('templates/header', $data) ?>

<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="symbol symbol-55px me-5">
                                <span class="symbol-label bg-light-primary">
                                    <i class="ki-solid ki-shop text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Detail Outlet</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Outlet</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Detail</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                        </div>
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Products-->
                <div class="d-flex flex-column flex-xl-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::Summary-->
                                <div class="d-flex flex-start flex-column">
                                    <!--begin::Avatar-->
                                    <div class="w-100 mb-7">
                                        <img src="<?= BASEURL ?>/upload/outlet/<?= $data['outlet']['foto'] !== '' ? $data['outlet']['foto'] : 'tmp.jpeg' ?>"
                                            alt="image" class="img-fluid rounded" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <div href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                                        <?= $data['outlet']['nama'] ?>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fs-5 fw-semibold text-muted mb-6">
                                        <i class="fa fa-location-dot fs-5 me-1 text-danger"></i>
                                        <?= $data['outlet']['alamat'] ?>
                                    </div>
                                    <!--end::Position-->
                                </div>
                                <div class="d-flex flex-wrap flex-center mb-5">
                                    <!--begin::Stats-->
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bold text-success">
                                            <span class="w-75px"  data-kt-countup="true" data-kt-countup-value="<?= $data['finance']['masuk']?>" data-kt-countup-prefix="Rp ">0</span>
                                        </div>
                                        <div class="fw-semibold text-muted">Total Debit</div>
                                    </div>
                                    <!--end::Stats-->
                                    <!--begin::Stats-->
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                        <div class="fs-4 fw-bold text-danger">
                                            <span class="w-50px" data-kt-countup="true" data-kt-countup-value="<?= $data['finance']['keluar'] ?>" data-kt-countup-prefix="Rp ">0</span>
                                        </div>
                                        <div class="fw-semibold text-muted">Total Kredit</div>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse"
                                        href="#kt_customer_view_details" role="button" aria-expanded="false"
                                        aria-controls="kt_customer_view_details">Details
                                        <span class="ms-2 rotate-180">
                                            <i class="ki-outline ki-down fs-3"></i>
                                        </span>
                                    </div>
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--begin::Details content-->
                                <div id="kt_customer_view_details" class="collapse show">
                                    <div class="pt-5 fs-6">
                                        <!--begin::Details item-->
                                        <div class="d-flex justify-content-start align-items-center column-gap-3 pb-5">
                                            <div>
                                                <div class="symbol symbol-55px me-5">
                                                    <span class="symbol-label bg-light-primary">
                                                        <i class="ki-solid ki-user text-primary fs-1"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="numbers">
                                                    <span class="fs-5 fw-bold text-gray-500 pb-2">Karyawan</span>
                                                    <div class="d-flex align-items-center">
                                                        <span class="fs-1 fw-bold text-gray-900 lh-1 ls-n2">
                                                            <?= count($data['karyawan']) ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="d-flex justify-content-start align-items-center column-gap-3 pb-5">
                                            <div>
                                                <div class="symbol symbol-55px me-5">
                                                    <span class="symbol-label bg-light-primary">
                                                        <i class="fa fa-utensils text-primary fs-1"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="numbers">
                                                    <span class="fs-5 fw-bold text-gray-500 pb-2">Menu</span>
                                                    <div class="d-flex align-items-center">
                                                        <span class="fs-1 fw-bold text-gray-900 lh-1 ls-n2">
                                                            <?= count($data['menu']) ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="d-flex justify-content-start align-items-center column-gap-3 pb-5">
                                            <div>
                                                <div class="symbol symbol-55px me-5">
                                                    <span class="symbol-label bg-light-primary">
                                                        <i class="ki-solid ki-parcel text-primary fs-1"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="numbers">
                                                    <span class="fs-5 fw-bold text-gray-500 pb-2">Barang</span>
                                                    <div class="d-flex align-items-center">
                                                        <span class="fs-1 fw-bold text-gray-900 lh-1 ls-n2">
                                                            <?= count($data['barang']) ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="d-flex justify-content-start align-items-center column-gap-3 pb-5">
                                            <div>
                                                <div class="symbol symbol-55px me-5">
                                                    <span class="symbol-label bg-light-primary">
                                                        <i class="ki-solid ki-dollar text-primary fs-1"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="numbers">
                                                    <span class="fs-5 fw-bold text-gray-500 pb-2">Total Debit</span>
                                                    <div class="d-flex align-items-center">
                                                        <span class="fs-1 fw-bold text-success lh-1 ls-n2">
                                                            Rp
                                                            <?= number_format($data['finance']['masuk'], 0, ',', '.') ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="d-flex justify-content-start align-items-center column-gap-3">
                                            <div>
                                                <div class="symbol symbol-55px me-5">
                                                    <span class="symbol-label bg-light-primary">
                                                        <i class="ki-solid ki-credit-cart text-primary fs-1"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="numbers">
                                                    <span class="fs-5 fw-bold text-gray-500 pb-2">Total Kredit</span>
                                                    <div class="d-flex align-items-center">
                                                        <span class="fs-1 fw-bold text-danger lh-1 ls-n2">
                                                            Rp
                                                            <?= number_format($data['finance']['keluar'], 0, ',', '.') ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Details item-->
                                    </div>
                                </div>
                                <!--end::Details content-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <!--begin:::Tabs-->
                        <ul
                            class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                    href="#kt_customer_view_overview_tab">Basic Info</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                    href="#kt_customer_view_overview_events_and_logs_tab">More Info</a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_customer_view_overview_tab" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Basic Info</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <div class="row g-9 mb-8">
                                            <div class="col-6 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Nama Cabang</label>
                                                <div class="input-group">
                                                    <input class="form-control form-control-solid" type="text"
                                                        value="<?= $data['outlet']['nama'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Manager</label>
                                                <div class="input-group">
                                                    <input class="form-control form-control-solid" type="text"
                                                        value=" <?= $data['outlet']['manager'] ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-9 mb-8">
                                            <div class="col-6 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Alamat</label>
                                                <div class="input-group">
                                                    <input class="form-control form-control-solid" type="text"
                                                        value=" <?= $data['outlet']['alamat'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6 fv-row">
                                                <div class="row g-2">
                                                    <div class="col-lg-6 fv-row">
                                                        <label class="fs-6 fw-semibold mb-2">Kota</label>
                                                        <div class="input-group">
                                                            <input class="form-control form-control-solid" type="text"
                                                                value=" <?= $data['outlet']['kota'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 fv-row">
                                                        <label class="fs-6 fw-semibold mb-2">Lokasi</label>
                                                        <div class="input-group">
                                                            <input class="form-control form-control-solid" type="text"
                                                                value=" <?= $data['outlet']['lokasi'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-9 mb-8">
                                            <div class="col-6 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Nomor Telepon</label>
                                                <div class="input-group">
                                                    <input class="form-control form-control-solid" type="text"
                                                        value="<?= $data['outlet']['nomor_telp'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Pajak</label>
                                                <div class="input-group">
                                                    <input class="form-control form-control-solid" type="text"
                                                        value=" <?= $data['outlet']['pajak'] ?>%" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end:::Tab pane-->
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade" id="kt_customer_view_overview_events_and_logs_tab"
                                role="tabpanel">
                                <div class="card card-flush mb-4">
                                    <!--begin::Card header-->
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <span
                                                class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                                Terdapat <?= count($data['karyawan']) ?> karyawan saat ini.</span>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                            <a href="<?= BASEURL ?>/karyawan"
                                                class="d-block btn btn-primary mb-0">Manage Karyawan</a>
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <div class="card-body pt-0">
                                        <div class="overflow-x-auto row flex-row flex-nowrap mx-0">
                                            <?php foreach ($data['karyawan'] as $karyawan): ?>
                                                <div class="col-sm-6 col-md-3 ps-0">
                                                    <a href="<?= BASEURL ?>/karyawan/detail/<?= $karyawan['id'] ?>"
                                                        class="card card-block card-dashed bg-light shadow-none card-1 h-100">
                                                        <div class="card-body">
                                                            <div
                                                                class="d-flex flex-column justify-content-between align-items-center h-100">
                                                                <div class="align-middle mb-3">
                                                                    <img src="<?= BASEURL ?>/upload/karyawan/<?= !empty($karyawan['foto']) ? $karyawan['foto'] : 'tmp.jpg' ?>"
                                                                        class="symbol symbol-75px w-75px h-75px symbol-label img-fluid shadow-md"
                                                                        style="object-fit: cover;" alt="foto_karyawan">
                                                                </div>
                                                                <div class="text-center">
                                                                    <h6 class="text-sm fw-bolder mb-1"
                                                                        style="line-height: 1.2rem;">
                                                                        <?= $karyawan['nama'] ?>
                                                                    </h6>
                                                                    <p class="text-sm text-muted fw-bold mb-2">
                                                                        <?= $karyawan['posisi'] ?>
                                                                    </p>
                                                                </div>
                                                                <div class="text-center font-weight-bold text-sm mb-0">
                                                                    <?php if ($karyawan['status_karyawan'] == 'Aktif'): ?>
                                                                        <span class="badge badge-light-success">Aktif</span>
                                                                    <?php else: ?>
                                                                        <span class="badge badge-secondary">Tidak
                                                                            Aktif</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-flush mb-4">
                                    <!--begin::Card header-->
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <span
                                                class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                                Terdapat <?= count($data['menu']) ?> menu tersedia saat ini.</span>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                            <a href="<?= BASEURL ?>/menu" class="d-block btn btn-primary mb-0">Manage
                                                Menu</a>
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <div class="card-body pt-0">
                                        <div class="overflow-x-auto row flex-row flex-nowrap mt-3 mx-0">
                                            <?php foreach ($data['menu'] as $menu): ?>
                                                <div class="col-sm-6 col-md-3 ps-0">
                                                    <div class="card card-block bg-light shadow-none card-1">
                                                        <div class="d-flex flex-column w-100">
                                                            <div class="overflow-hidden rounded-top-4 rounded-bottom-2"
                                                                style="max-height: 120px !important;">
                                                                <img src="<?= BASEURL ?>/upload/menu/<?= $menu['foto'] != '' ? $menu['foto'] : 'tmp.png' ?>"
                                                                    style="min-height: 120px; max-height: 150px; object-fit: cover;"
                                                                    class="img-fluid rounded-start p-0 w-100"
                                                                    alt="<?= $menu['nama']; ?>">
                                                            </div>
                                                            <div class="card-body text-start py-3 text-nowrap h-100">
                                                                <h6 class="fs-6 fw-bolder mb-0"
                                                                    style="text-overflow: ellipsis; overflow: hidden;">
                                                                    <?= $menu['nama']; ?>
                                                                    <?php if ($menu['outlet_uuid'] == $data['user']['outlet_uuid']): ?>
                                                                        <span class="badge bg-gradient-warning ms-1 text-xxs"
                                                                            style="transform: translateY(-2px);">EXC</span>
                                                                    <?php endif; ?>
                                                                </h6>
                                                                <p class="text-sm text-muted mb-1"><?= $menu['kategori'] ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center gap-2">
                                            <span
                                                class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Terdapat
                                                <?= count($data['barang']) ?> jenis
                                                barang di dalam stok saat ini.</span>
                                            <a href="<?= BASEURL ?>/stok" class="d-block btn btn-primary mb-0">Manage
                                                Stok</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end:::Tab pane-->
                        </div>
                        <!--end:::Tab content-->
                    </div>
                </div>

                <?php Get::view('templates/footer', $data) ?>