<?php Get::view('templates/header', $data) ?>

<div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('<?= BASEURL; ?>/img/curved-images/curved0.jpg'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
</div>
<div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="row gx-4">
        <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <img src="<?= BASEURL; ?>/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
        </div>
        <div class="col-auto my-auto">
            <div class="h-100">
                <h5 class="mb-1">
                    <?= $data['user']['username'] ?>
                </h5>
                <p class="mb-0 font-weight-bold text-sm">
                    <?= $data['user']['role'] ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid my-3 py-3">
    <div class="row mb-5">

        <div class="col-lg-3">
            <div class="card position-sticky top-1">
                <ul class="nav flex-column bg-white border-radius-lg p-3">
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll href="#basic-info">
                            <div class="icon me-2">
                                <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>document</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(154.000000, 300.000000)">
                                                    <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" opacity="0.603585379"></path>
                                                    <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <span class="text-sm">Basic Info</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll href="#password">
                            <div class="icon me-2">
                                <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>box-3d-50</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(603.000000, 0.000000)">
                                                    <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                                                    </path>
                                                    <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" opacity="0.7"></path>
                                                    <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" opacity="0.7"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <span class="text-sm">Change Password</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-9 mt-lg-0 mt-4">
            <div class="card" id="basic-info">
                <div class="card-header">
                    <h5>Basic Info</h5>
                </div>
                <div class="card-body overflow-auto pt-0">
                    <form action="<?= BASEURL; ?>/profile/update" method="post" id="updateProfile">
                        <?= csrf() ?>
                        <input type="hidden" name="id" value="<?= $data['user']['id'] ?>">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Username</label>
                                <div class="input-group">
                                    <input id="username" name="username" class="form-control" type="text" value=" <?= $data['user']['username'] ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <input id="email" name="email" class="form-control" type="text" value=" <?= $data['user']['email'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <label class="form-label">Role</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" value=" <?= $data['user']['role'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last Login</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" value=" <?= $data['user']['last_login_at'] ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-gradient-dark btn-md float-end mt-4 mb-0">Update Profile</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5>Change Password</h5>
                </div>
                <div class="card-body pt-0">
                    <form action="<?= BASEURL; ?>/profile/changePassword" method="post" id="changePassword">
                        <?= csrf() ?>
                        <input type="hidden" name="id" value="<?= $data['user']['id'] ?>">
                        <div class="form-group">
                            <label class="form-label">Old password</label>
                            <input class="form-control" type="password" name="old_password" placeholder="Old password" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">New password</label>
                            <input class="form-control" type="password" name="new_password" id="password" placeholder="New password" required>
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
                        <button type="submit" class="btn bg-gradient-dark btn-md float-end mt-6 mb-0">Update Password</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
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

    $('#password').on('input', function() {
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

    $('#changePassword').on('submit', function(e) {
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