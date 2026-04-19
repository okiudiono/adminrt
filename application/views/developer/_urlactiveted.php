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
            <div class="col-md-2" align="center">

            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h2 class="section-title">Formulir Aktivasi Akun!</h2>
                        </div>

                        <div class="card-body">

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
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required="" autofocus="" value="<?= @$email ?>" placeholder="Email" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">Username</label>
                                    <input id="u_username" type="text" class="form-control" name="u_username" tabindex="1" required="" autofocus="" value="<?= set_value('username') ?>" placeholder="Username">
                                    <div class="invalid-feedback">
                                        Username tidak boleh kosong.
                                    </div>
                                    <div class="invalid-feedback-new">
                                        <?= form_error('username') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Password*</label>
                                    <input id="password" type="text" class="form-control" name="password" tabindex="1" required="" autofocus="" value="<?= set_value('password') ?>" placeholder="Password">
                                    <div class="invalid-feedback">
                                        Password tidak boleh kosong.
                                    </div>
                                    <div class="invalid-feedback-new">
                                        <?= form_error('password') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Konfirmasi Password*</label>
                                    <input id="re_password" type="text" class="form-control" name="re_password" tabindex="1" required="" autofocus="" value="<?= set_value('re_password') ?>" placeholder="Konfirmasi Password">
                                    <div class="invalid-feedback">
                                        Konfirmasi Password tidak boleh kosong.
                                    </div>
                                    <div class="invalid-feedback-new">
                                        <?= form_error('re_password') ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="email">Nama</label>
                                    <input id="u_nama" type="text" class="form-control" name="u_nama" tabindex="1" required="" autofocus="" value="<?= set_value('u_nama') ?>" placeholder="Nama">
                                    <div class="invalid-feedback">
                                        Nama tidak boleh kosong.
                                    </div>
                                    <div class="invalid-feedback-new">
                                        <?= form_error('u_nama') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Tipe Profesi</label>
                                    <select class="form-control" id="profesi" name="profesi" required="" autofocus="">
                                        <option value="">--Pilih Tipe Profesi--</option>
                                        <option>Indonesia</option>
                                        <option>Palestine</option>
                                        <option>Syria</option>
                                        <option>Malaysia</option>
                                        <option>Thailand</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        profesi tidak boleh kosong.
                                    </div>
                                    <div class="invalid-feedback-new">
                                        <?= form_error('profesi') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="organ">Nama Instansi/Organisasi*</label>
                                    <input id="organisasi" type="text" class="form-control" name="organisasi" tabindex="1" required="" autofocus="" value="<?= set_value('organisasi') ?>" placeholder="Nama Instansi/Organisasi">
                                    <div class="invalid-feedback">
                                        Nama Instansi/Organisasi tidak boleh kosong.
                                    </div>
                                    <div class="invalid-feedback-new">
                                        <?= form_error('organisasi') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tujuan">Tujuan Penggunaan Api*</label>
                                    <select class="form-control" id="tujuan" name="tujuan" required="" autofocus="">
                                        <option value="">--Pilih Tujuan Penggunaan Api--</option>
                                        <option>Indonesia</option>
                                        <option>Palestine</option>
                                        <option>Syria</option>
                                        <option>Malaysia</option>
                                        <option>Thailand</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Tujuan Penggunaan Api tidak boleh kosong.
                                    </div>
                                    <div class="invalid-feedback-new">
                                        <?= form_error('tujuan') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat Instansi/Organisasi*</label>
                                    <input id="alamat_organ" type="text" class="form-control" name="alamat_organ" tabindex="1" required="" autofocus="" value="<?= set_value('alamat_organ') ?>" placeholder="Alamat Instansi/Organisasi">
                                    <div class="invalid-feedback">
                                        Alamat Instansi/Organisasi tidak boleh kosong.
                                    </div>
                                    <div class="invalid-feedback-new">
                                        <?= form_error('alamat_organ') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Buat Akun
                                    </button>
                                </div>
                                <div class="mt-5 text-muted text-center">
                                    Sudah mempunyai akun? <a href="<?= @base_url('developer/login') ?>">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-2" align="center">

            </div>

        </div>
    </section>
</div>