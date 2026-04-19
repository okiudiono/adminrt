<style>
    .invalid-feedback-new:empty {
        display: none;
    }

    .invalid-feedback-new {
        font-size: smaller;
        color: rgb(153, 16, 16);
    }
</style>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-md-6">
                <div class="card-body">
                    <h2 class="section-title">Buat Akun!</h2>
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="<?= base_url('developer/daftar') ?>" class="needs-validation" novalidate="">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" tabindex="1" required="" autofocus="" value="<?= set_value('email') ?>" placeholder="Email">

                            <div class="invalid-feedback">
                                Email tidak boleh kosong.
                            </div>
                            <div class="invalid-feedback-new">
                                <?= form_error('email') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Konfirmasi Email</label>
                            <input id="re_email" type="re_email" class="form-control" name="re_email" tabindex="1" required="" autofocus="" value="<?= set_value('re_email') ?>" placeholder="Konfirmasi Email">
                            <div class="invalid-feedback">
                                Email tidak boleh kosong.
                            </div>
                            <div class="invalid-feedback-new">
                                <?= form_error('re_email') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Kirim Pengajuan
                            </button>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Sudah mempunyai akun? <a href="<?= @base_url('developer/login') ?>">Login</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6" align="center">
                <img alt="image" style="width: 102%;" src="<?= asset("assets/img/reguser.png") ?>">
            </div>

        </div>
    </section>
</div>