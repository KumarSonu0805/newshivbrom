
            <div class="login-box">
                <!-- /.login-logo -->
                <div class="card card-outline card-sc-green">
                    <div class="card-header text-center">
                    <a href="<?= base_url(); ?>" class="h1"><img src="<?= file_url('assets/images/logo.png') ?>" alt="<?= PROJECT_NAME ?> Logo" class="img-fluid"></a>
                    </div>
                    <div class="card-body bg-white">
                        <h2 class="login-title">Registered Successfully</h2>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <h4>Welcome <?php echo $this->session->flashdata('mname'); ?>,</h4><br>
                                <ul style="list-style:none;">
                                    <li><h4>Username : <?php echo $this->session->flashdata('uname');?></h4><br></li>
                                    <li><h4>Password : <?php echo $this->session->flashdata('pass');?></h4></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.login-box -->

