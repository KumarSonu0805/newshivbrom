
<style>

</style>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                    </div>

                    <div class="card-body">

                        <!-- Step Navigation -->
                        <ul class="nav nav-pills nav-justified mb-3" id="stepTabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#step1" data-toggle="pill">Booking Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#<?= $f_type=='new'?'':'step2'; ?>" data-toggle="pill">KYC</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#<?= $f_type=='new'?'':'step3'; ?>" data-toggle="pill">Nominee Details</a>
                            </li>
                        </ul>

                        <!-- Form -->
                        <div id="multiStepForm">
                            <div class="tab-content">

                                <!-- Step 1 -->
                                <div class="tab-pane fade show active" id="step1">
                                    <?php echo form_open_multipart('bookings/savebooking', 'id="myform" onsubmit="return validate()"'); ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("Placeholder"=>"Registration No.","autocomplete"=>"off",'readonly'=>'true');
                                                        echo create_form_input("text","","Registration No.",true,$user['username'],$attributes); 
                                                        echo create_form_input("hidden","regid","",false,$user['id'],array("id"=>"regid")); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"refname","Placeholder"=>"Name",
                                                                          "autocomplete"=>"off","readonly"=>true);
                                                        echo create_form_input("text","","Name",true,$user['name'],$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Booking For <span class="text-danger">*</span></label>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" id="bf_self" name="booking_for" value="Self" required >
                                                        <label for="bf_self">Self</label>
                                                    </div>
                                                    <div class="ml-2 icheck-success d-inline">
                                                        <input type="radio" id="bf_other" name="booking_for" value="Other" >
                                                        <label for="bf_other">Other</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Type <span class="text-danger">*</span></label>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" id="t_fp" name="type" value="full_payment" required >
                                                        <label for="t_fp">Full Payment</label>
                                                    </div>
                                                    <div class="ml-2 icheck-success d-inline">
                                                        <input type="radio" id="t_emi" name="type" value="emi" >
                                                        <label for="t_emi">EMI</label>
                                                    </div>
                                                    <div class="ml-2 icheck-success d-inline">
                                                        <input type="radio" id="t_hold" name="type" value="hold" >
                                                        <label for="t_hold">Hold</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 d-none">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"due_date","Placeholder"=>"Due Date","autocomplete"=>"off");
                                                        echo create_form_input("date","due_date","Due Date",false,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"name","Placeholder"=>"Purchaser Name","autocomplete"=>"off");
                                                        echo create_form_input("text","name","Purchaser Name",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"father","Placeholder"=>"Father/Husband Name","autocomplete"=>"off");
                                                        echo create_form_input("text","father","Father/Husband Name",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"grand_father","Placeholder"=>"Grand Father Name","autocomplete"=>"off");
                                                        echo create_form_input("text","grand_father","Grand Father Name",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"mobile","Placeholder"=>"Mobile",
                                                                          "autocomplete"=>"off","pattern"=>"[0-9]{10}",
                                                                          "title"=>"Enter Valid Mobile No.",
                                                                          "maxlength"=>"10");
                                                        echo create_form_input("text","mobile","Mobile",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"a_mobile",
                                                                          "Placeholder"=>"Alternate Mobile",
                                                                          "autocomplete"=>"off","pattern"=>"[0-9]{10}",
                                                                          "title"=>"Enter Valid Mobile No.",
                                                                          "maxlength"=>"10");
                                                        echo create_form_input("text","a_mobile","Alternate Mobile",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"email","Placeholder"=>"Email",
                                                                          "autocomplete"=>"off");
                                                        echo create_form_input("email","email","Email",false,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"address","Placeholder"=>"Address",
                                                                          "autocomplete"=>"off",'rows'=>3);
                                                        echo create_form_input("textarea","address","Address",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"state_id",'class'=>'dropdowns');
                                                        echo create_form_input("select","state_id","State",true,'',$attributes,state_dropdown()); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"district_id",'class'=>'dropdowns');
                                                        echo create_form_input("select","district_id","District",true,'',$attributes,[''=>'Select District']); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"city_id",'class'=>'dropdowns city');
                                                        echo create_form_input("select","city_id","City",true,'',$attributes,[''=>'Select City']); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"pincode","Placeholder"=>"Pincode",
                                                                          "autocomplete"=>"off");
                                                        echo create_form_input("text","pincode","Pincode",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="header smaller lighter">Booking Information</h3>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"booking_type");
                                                        echo create_form_input("select","booking_type","Booking Type",true,'',$attributes,bookingtype_dropdown()); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"project_id");
                                                        echo create_form_input("select","project_id","Project",true,'',$attributes,project_dropdown()); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"plot_no","Placeholder"=>"Flat/Plot No.",
                                                                          "autocomplete"=>"off");
                                                        echo create_form_input("text","plot_no","Flat/Plot No.",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"b_address","Placeholder"=>"Address",
                                                                          "autocomplete"=>"off",'rows'=>3);
                                                        echo create_form_input("textarea","b_address","Address",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"b_state_id",'class'=>'dropdowns');
                                                        echo create_form_input("select","b_state_id","State",true,'',$attributes,state_dropdown()); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"b_district_id",'class'=>'dropdowns');
                                                        echo create_form_input("select","b_district_id","District",true,'',$attributes,[''=>'Select District']); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"b_city_id",'class'=>'dropdowns city');
                                                        echo create_form_input("select","b_city_id","City",true,'',$attributes,[''=>'Select City']); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"landmark","Placeholder"=>"Landmark",
                                                                          "autocomplete"=>"off");
                                                        echo create_form_input("text","landmark","Landmark",false,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"price","Placeholder"=>"Price",
                                                                          "autocomplete"=>"off",'step'=>'0.01');
                                                        echo create_form_input("number","price","Price",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"other_price","Placeholder"=>"Other Price",
                                                                          "autocomplete"=>"off",'step'=>'0.01');
                                                        echo create_form_input("number","other_price","Other Price",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"total_amount",'readonly'=>'true',
                                                                          "Placeholder"=>"Final Amount",
                                                                          "autocomplete"=>"off",'step'=>'0.01');
                                                        echo create_form_input("number","total_amount","Final Amount",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"payment_type");
                                                        echo create_form_input("select","payment_type","Payment Type",true,'',$attributes,paymenttype_dropdown()); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"payment_date");
                                                        echo create_form_input("date","payment_date","Payment Date",true,date('Y-m-d'),$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"payment_mode");
                                                        echo create_form_input("select","payment_mode","Payment Mode",true,'',$attributes,paymentmode_dropdown()); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"paid_amount","Placeholder"=>"Paid Amount",
                                                                          "autocomplete"=>"off",'step'=>'0.01');
                                                        echo create_form_input("number","paid_amount","Paid Amount",true,'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-sm btn-success" name="savebooking">Save Booking</button>
                                            </div>
                                        </div>
                                    <?= form_close(); ?>
                                </div>

                                <!-- Step 2 -->
                                <div class="tab-pane fade" id="step2">
                                <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" required>
                                </div>

                                <button type="button" class="btn btn-secondary prev-step">
                                Previous
                                </button>

                                <button type="button" class="btn btn-primary float-right next-step">
                                Next
                                </button>
                                </div>

                                <!-- Step 3 -->
                                <div class="tab-pane fade" id="step3">
                                <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" required>
                                </div>

                                <button type="button" class="btn btn-secondary prev-step">
                                Previous
                                </button>

                                <button type="submit" class="btn btn-success float-right">
                                Submit
                                </button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function(){
                    $('body').on('change','input[name="type"]',function(){
                        var type=$('input[name="type"]:checked').val();
                        $('#payment_type,#paid_amount').val('');
                        $('#paid_amount').prop('readonly',true);
                        $('#payment_type option').show();
                        if(type=='full_payment'){
                        }
                        else if(type=='emi'){
                        }
                        else if(type=='hold'){
                            $('#payment_type option').hide();
                            $('#payment_type option[value="token"]').show();
                            $('#payment_type').val('token');
                            $('#paid_amount').val('11000');
                        }
                    });
                    $('body').on('change','#state_id',function(){
                        var district_id=$(this).attr('data-district_id');
                        $('#city_id').html('<option value="">Select City</option>');
                        $.ajax({
                            type:"post",
                            url:"<?= base_url('masterkey/getdistrictdropdown/'); ?>",
                            data:{state_id:$(this).val(),district_id:district_id},
                            success:function(data){
                                $('#district_id').replaceWith(data);
                            }
                        });
                    });
                    $('body').on('change','#district_id',function(){
                        var city_id=$(this).attr('data-city_id');
                        $.ajax({
                            type:"post",
                            url:"<?= base_url('masterkey/getcitydropdown/'); ?>",
                            data:{district_id:$(this).val(),city_id:city_id},
                            success:function(data){
                                $('#city_id').replaceWith(data);
                            }
                        });
                    });
                    $('body').on('change','#b_state_id',function(){
                        var district_id=$(this).attr('data-district_id');
                        $('#b_city_id').html('<option value="">Select City</option>');
                        $.ajax({
                            type:"post",
                            url:"<?= base_url('masterkey/getdistrictdropdown/'); ?>",
                            data:{state_id:$(this).val(),district_id:district_id},
                            success:function(data){
                                data = data.replace(/district_id/g, "b_district_id");
                                $('#b_district_id').replaceWith(data);
                            }
                        });
                    });
                    $('body').on('change','#b_district_id',function(){
                        var city_id=$(this).attr('data-city_id');
                        $.ajax({
                            type:"post",
                            url:"<?= base_url('masterkey/getcitydropdown/'); ?>",
                            data:{district_id:$(this).val(),city_id:city_id},
                            success:function(data){
                                data = data.replace(/city_id/g, "b_city_id");
                                $('#b_city_id').replaceWith(data);
                            }
                        });
                    });
                    $('body').on('keyup','#price,#other_price',function(){
                        var price=Number($('#price').val());
                        price=isNaN(price)?0:price;
                        var other_price=Number($('#other_price').val());
                        other_price=isNaN(other_price)?0:other_price;
                        var total=price+other_price;
                        $('#total_amount').val(total);
                    });
                    $('body').on('change','#payment_type',function(){
                        var type=$(this).val();
                        $('#paid_amount').prop('readonly',false);
                        $('#paid_amount').val('');
                        $('#paid_amount').attr('min','0');
                        if(type=='full_payment'){
                            $('#paid_amount').val($('#total_amount').val());
                            $('#paid_amount').prop('readonly',true);
                        }
                        else if(type=='partial'){
                            $('#paid_amount').attr('min','10100');
                        }
                        else if(type=='token'){
                            $('#paid_amount').attr('min','10100');
                        }
                    });
                });
            </script>