<link rel="stylesheet" href="<?= file_url('includes/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
            <div class="login-box">
                <!-- /.login-logo -->
                <div class="card card-outline card-sc-green">
                    <div class="card-header text-center">
                    <a href="<?= base_url(); ?>" class="h1"><img src="<?= file_url('assets/images/logo.png') ?>" alt="<?= PROJECT_NAME ?> Logo" class="img-fluid"></a>
                    </div>
                    <div class="card-body bg-white">
                        <p class="login-box-msg">Register</p>
                        <?= form_open('members/addmember'); ?>
                            <label class="mb-0" for="ref">Reference ID</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="" id="ref" placeholder="Reference ID" required value="<?= $username??'' ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                <?php
                                    echo create_form_input("hidden","refid","",false,$user['regid']??'',array("id"=>"refid")); 
                                ?>
                            </div>
                            <div style="padding:0 10px; font-size:16px; font-weight:600; clear:both;" class=" mb-3" id="refdiv"></div>
                            <label class="mb-0" for="position">Position</label>
                            <div class="input-group mb-3">
                                <select name="position" id="position" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="L">Left</option>
                                    <option value="R">Right</option>
                                </select>
                            </div>
                            <label class="mb-0" for="name">Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <label class="mb-0" for="email">Email</label>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <label class="mb-0" for="mobile">Mobile</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="mobile" placeholder="Mobile" pattern="[0-9]{10}" title="Enter Valid Mobile No." maxlength="10" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <label class="mb-0" for="mobile">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-danger text-center mb-2"><?= $this->session->flashdata('logerr'); ?></div>
                            <div class="row">
                                <div class="col-8 d-none">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">
                                        Remember Me
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    <button type="submit" name="addmember" id="savebtn" class="btn btn-sc-green btn-block">Sign In</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        <?= form_close(); ?>

                        <p class="mb-1 d-none">
                            <a href="<?= base_url('forgot-password/'); ?>">I forgot my password</a>
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.login-box -->
            
            <script>
                $(document).ready(function(e) {  
                    $('#ref').keyup(function(){
                        getrefid();
                    }); 
                    $('#ref').blur(function(){
                        getrefid();
                    });
                    if($('#ref').val()!=''){
                        $('#ref').trigger('keyup');
                    }
                });

                function getrefid(){

                    var username=$('#ref').val();
                    $('#refid').val('');
                    $('#refdiv').removeClass('text-danger').removeClass('text-success').html('');
                    //$('#position-div').html('');
                    $('#savebtn').attr("disabled",true);
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url("members/getrefid/"); ?>",
                        data:{username:username,status:'all'},
                        beforeSend: function(data){
                            $('#refdiv').html($('#dot-loader').html());
                        },
                        success: function(data){
                            data=JSON.parse(data);
                            if(data['regid']=='' || data['regid']==0){
                                $('#refdiv').html(data['name']).addClass('text-danger');
                            }else{
                                $('#refid').val(data['regid']);
                                $('#refdiv').html(data['name']).addClass('text-success');
                                $('#savebtn').removeAttr("disabled");
                            }

                        }
                    });
                }

                function setChosenSelect(ele){
                    ele.chosen({
                        disable_search_threshold: 10,
                        no_results_text: "Oops, nothing found!",
                        width: "100%"
                    });
                }

                function validate(){
                    $('#savebtn').hide();
                }
            </script>