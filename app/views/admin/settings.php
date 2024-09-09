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
                                    <i class="ki-solid ki-setting-3 text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Settings</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Admin</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Settings</li>
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
                <form class="container-md overflow-hidden" action="<?= BASEURL ?>/settings/update" method="post">
                    <?= csrf() ?>
                    <?php foreach ($data['categories'] as $category): ?>
                        <div class="mb-8">
                            <h2 class="border-bottom py-3 mb-3"><?= $category ?> Settings</h2>

                            <?php foreach ($data['preferences'] as $preference): ?>
                                <?php if ($preference['category'] != $category)
                                    continue; ?>
                                <div class="mb-8 fv-row">
                                    <label for="<?= $preference['setting'] ?>"
                                        class="required form-label fs-6 fw-semibold mb-2"><?= str_replace('_', ' ', $preference['setting']) ?></label>
                                    <input type="text" class="form-control form-control-solid" id="<?= $preference['setting'] ?>"
                                        name="<?= $preference['setting'] ?>" value="<?= $preference['value'] ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>

                    <br>
                    <button type="submit" class="btn btn-primary float-end"
                        onclick="return confirm('Apakah anda yakin ingin menyimpan perubahan?')">
                        <i class="fa fa-save me-2"></i>
                        Simpan
                    </button>
                </form>
            </div>
        </div>

        <?php Get::view('templates/footer', $data) ?>