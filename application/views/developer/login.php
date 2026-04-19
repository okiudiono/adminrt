<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-md-6">
                <div class="card-body">
                    <h2 class="section-title">Halo, Sahabat Data!</h2>
                    <form method="POST" action="<?= base_url('developer/exc_login') ?>" class="needs-validation" novalidate="">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" tabindex="1" required="" autofocus="">
                            <div class="invalid-feedback">
                                Please fill in your email
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Password</label>
                                <div class="float-right">
                                    <a href="auth-forgot-password.html" class="text-small">
                                        Forgot Password?
                                    </a>
                                </div>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required="">
                            <div class="invalid-feedback">
                                please fill in your password
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Login
                            </button>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Belum mempunyai akun? <a href="<?= @base_url('developer/daftar') ?>">Daftar</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6" align="center">
                <img alt="image" style="width: 100%;" src="<?= asset("assets/img/loginfront.png") ?>">
            </div>

        </div>
    </section>
</div>