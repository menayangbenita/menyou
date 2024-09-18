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
                        <!--begin::Title-->
                        <h1
                            class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                            Profile</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="index.html" class="text-muted text-hover-primary">Dashboard</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Profile</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
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
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-xl-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Card body-->
                            <div class="card-body pt-15">
                                <!--begin::Summary-->
                                <div class="d-flex flex-center flex-column mb-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-100px symbol-circle mb-7">
                                        <img src="<?= BASEURL ?>/media/avatars/blank.png" alt="image" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#"
                                        class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1"><?= $data['user']['username'] ?></a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fs-5 fw-semibold text-muted mb-6"><?= $data['user']['role'] ?></div>
                                    <!--end::Position-->
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
                                    <div class="py-5 fs-6">
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Outlet</div>
                                        <div class="text-gray-600"><?= $data['user']['outlet_uuid'] ?></div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Email</div>
                                        <div class="text-gray-600">
                                            <a href="#"
                                                class="text-gray-600 text-hover-primary"><?= $data['user']['email'] ?></a>
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
                                    href="#kt_customer_view_overview_events_and_logs_tab">Change Password</a>
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
                                        <form action="<?= BASEURL; ?>/profile/update" method="post" id="updateProfile">
                                            <?= csrf() ?>
                                            <input type="hidden" name="id" value="<?= $data['user']['id'] ?>">
                                            <div class="row g-9 mb-8">
                                                <div class="col-6 fv-row">
                                                    <label class="form-label">Username</label>
                                                    <div class="input-group">
                                                        <input id="username" name="username"
                                                            class="form-control form-control-solid" type="text"
                                                            value=" <?= $data['user']['username'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-6 fv-row">
                                                    <label class="form-label">Email</label>
                                                    <div class="input-group">
                                                        <input id="email" name="email"
                                                            class="form-control form-control-solid" type="text"
                                                            value=" <?= $data['user']['email'] ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-9 mb-8">
                                                <div class="col-6 fv-row">
                                                    <label class="form-label">Role</label>
                                                    <div class="input-group">
                                                        <input class="form-control form-control-solid" type="text"
                                                            value=" <?= $data['user']['role'] ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-6 fv-row">
                                                    <label class="form-label">Last Login</label>
                                                    <div class="input-group">
                                                        <input class="form-control form-control-solid" type="text"
                                                            value=" <?= $data['user']['last_login_at'] ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-primary btn-md float-end mt-4 mb-0">Update
                                                Profile</button>
                                        </form>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end:::Tab pane-->
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade" id="kt_customer_view_overview_events_and_logs_tab"
                                role="tabpanel">
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Change Password</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <form action="<?= BASEURL; ?>/profile/changePassword" method="post"
                                            id="changePassword">
                                            <?= csrf() ?>
                                            <input type="hidden" name="id" value="<?= $data['user']['id'] ?>">
                                            <div class="fv-row mb-8">
                                                <label class="required fs-6 fw-semibold mb-2">Old password</label>
                                                <input class="form-control form-control-solid" type="password" name="old_password"
                                                    placeholder="Old password" required>
                                            </div>
                                            <div class="mb-8 fv-row">
                                                <label class="required fs-6 fw-semibold mb-2">New password</label>
                                                <input class="form-control form-control-solid" type="password" name="new_password"
                                                    id="password" placeholder="New password" required>
                                                <span class="text-sm fw-bold subtitle"></span>
                                            </div>
                                            <h5 class="mt-5">Password requirements</h5>
                                            <p class="text-muted mb-2">
                                                Please follow this guide for a strong password:
                                            </p>
                                            <ul class="text-muted ps-4 mb-0 float-start">
                                                <li><span class="text-sm">Minimum 8 characters <b>(must)</b></span></li>
                                                <li><span class="text-sm">Contain special characters</span></li>
                                                <li><span class="text-sm">Contain numbers</span></li>
                                            </ul>
                                            <button type="submit"
                                                class="btn btn-primary btn-md float-end mt-6 mb-0">Update
                                                Password</button>
                                        </form>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end:::Tab pane-->
                        </div>
                        <!--end:::Tab content-->
                    </div>
                    <!--end::Content-->
                </div>

                <script>
                    function validatePassword(password) {
                        let specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
                        let numericRegex = /\d/;

                        if (password.length >= 8) {
                            if (specialCharRegex.test(password) && numericRegex.test(password)) {
                                return 1;
                            } else {
                                return 0;
                            }
                        } else {
                            return -1;
                        }
                    }

                    $('#password').on('input', function () {
                        let password = $('#password').val();
                        let validate = validatePassword(password);

                        console.log(validate);

                        if (password.length == 0) {
                            $('#password')
                                .removeClass('border-warning')
                                .removeClass('border-success')
                                .removeClass('border-danger')
                        } else if (password.length < 8) {
                            $('#password')
                                .removeClass('border-success')
                                .removeClass('border-danger')
                                .addClass('border-warning')
                            $('span.subtitle')
                                .removeClass('border-success')
                                .removeClass('border-danger')
                                .addClass('border-warning')
                                .html('Password length must 8 char!')
                        } else if (validate == 0) {
                            $('#password')
                                .removeClass('border-success')
                                .removeClass('border-danger')
                                .addClass('border-warning')
                            $('span.subtitle')
                                .removeClass('border-success')
                                .removeClass('border-danger')
                                .addClass('border-warning')
                                .html('Consider using special characters and numbers.')
                        } else {
                            $('#password')
                                .removeClass('border-warning')
                                .removeClass('border-danger')
                                .addClass('border-success')
                            $('span.subtitle')
                                .removeClass('border-warning')
                                .removeClass('border-success')
                                .addClass('border-danger')
                                .html('Strong enough.')
                        }
                    });

                    $('#changePassword').on('submit', function (e) {
                        if (validatePassword($('#password').val()) == -1) {
                            e.preventDefault();
                            $('#password')
                                .removeClass('border-warning')
                                .removeClass('border-success')
                                .addClass('border-danger')
                            $('span.subtitle')
                                .removeClass('border-warning')
                                .removeClass('border-success')
                                .addClass('border-danger')
                                .html('Password length must 8 char!')
                        } else {
                            $('span.subtitle')
                                .removeClass('border-warning')
                                .removeClass('border-danger')
                                .addClass('border-success')
                        }
                    });
                </script>

                <?php Get::view('templates/footer', $data) ?>