
<style>
    #nomineeform{
        display: block;
    }
    .img-fluid{
        max-height: 150px;
    }
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
                                <a class="nav-link" href="#<?= $f_type=='new'?'':'step2'; ?>" id="kyc-link" data-toggle="pill">KYC Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#<?= $f_type=='new' || $f_type=='kyc'?'':'step3'; ?>" id="nominee-link" data-toggle="pill">Nominee Details</a>
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
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"date","Placeholder"=>"Booking Date","autocomplete"=>"off");
                                                        echo create_form_input("date","date","Booking Date",true,$booking['date']??date('Y-m-d'),$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Type <span class="text-danger">*</span></label>
                                                <?php
                                                $b_type=$booking['type']??'';
                                                ?>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" id="t_fp" name="type" value="full_payment" required <?= $b_type=='full_payment'?'checked':'' ?>>
                                                        <label for="t_fp">Full Payment</label>
                                                    </div>
                                                    <div class="ml-2 icheck-success d-inline">
                                                        <input type="radio" id="t_emi" name="type" value="emi" <?= $b_type=='emi'?'checked':'' ?>>
                                                        <label for="t_emi">EMI</label>
                                                    </div>
                                                    <div class="ml-2 icheck-success d-inline">
                                                        <input type="radio" id="t_hold" name="type" value="hold" <?= $b_type=='hold'?'checked':'' ?>>
                                                        <label for="t_hold">Hold</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 <?= $b_type!='hold'?'d-none':'' ?>">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"due_date","Placeholder"=>"Due Date","autocomplete"=>"off",'data-value'=>date('Y-m-d',strtotime('+7 days')));
                                                        echo create_form_input("date","due_date","Due Date",false,$booking['due_date']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 <?= $b_type!='emi'?'d-none':'' ?>">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"duration");
                                                        echo create_form_input("select","duration","EMI Duration",false,$booking['duration']??'',$attributes,[''=>'Select','12'=>'12 Months','18'=>'18 Months']); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"booking_type");
                                                        echo create_form_input("select","booking_type","Booking Type",true,$booking['booking_type']??'',$attributes,bookingtype_dropdown()); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"project_id");
                                                        echo create_form_input("select","project_id","Project",true,$booking['project_id']??'',$attributes,project_dropdown()); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"plot_no","Placeholder"=>"Flat/Plot No.",
                                                                          "autocomplete"=>"off");
                                                        echo create_form_input("text","plot_no","Flat/Plot No.",true,$booking['plot_no']??'',$attributes); 
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
                                                        echo create_form_input("textarea","b_address","Address",true,$booking['b_address']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"b_state_id",'class'=>'dropdowns');
                                                        echo create_form_input("select","b_state_id","State",true,$booking['b_state_id']??'',$attributes,state_dropdown()); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"b_district_id",'class'=>'dropdowns');
                                                        echo create_form_input("select","b_district_id","District",true,$booking['b_district_id']??'',$attributes,$b_districts??[''=>'Select District']); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"b_city_id",'class'=>'dropdowns city');
                                                        echo create_form_input("select","b_city_id","City",true,$booking['b_city_id']??'',$attributes,$b_cities??[''=>'Select City']); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"landmark","Placeholder"=>"Landmark",
                                                                          "autocomplete"=>"off");
                                                        echo create_form_input("text","landmark","Landmark",false,$booking['landmark']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"price","Placeholder"=>"Price",
                                                                          "autocomplete"=>"off",'step'=>'0.01',
                                                                          'readonly'=>'true');
                                                        echo create_form_input("number","price","Price",true,$booking['price']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"other_price","Placeholder"=>"Other Price",
                                                                          "autocomplete"=>"off",'step'=>'0.01',
                                                                          'readonly'=>'true');
                                                        echo create_form_input("number","other_price","Other Price",true,$booking['other_price']??0,$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"total_amount",'readonly'=>'true',
                                                                          "Placeholder"=>"Final Amount",
                                                                          "autocomplete"=>"off",'step'=>'0.01');
                                                        echo create_form_input("number","total_amount","Final Amount",true,$booking['total_amount']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"payment_type");
                                                        echo create_form_input("select","payment_type","Payment Type",true,$booking['payment']['payment_type']??'',$attributes,paymenttype_dropdown()); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"payment_date");
                                                        echo create_form_input("date","payment_date","Payment Date",true,$booking['payment']['date']??date('Y-m-d'),$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"payment_mode");
                                                        echo create_form_input("select","payment_mode","Payment Mode",true,$booking['payment']['payment_mode']??'',$attributes,paymentmode_dropdown()); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $paymode=$booking['payment']['payment_mode']??''; ?>
                                        <div class="row">
                                            <div class="col-md-4 <?= $paymode=='cheque' || $paymode=='cash' ?'':'d-none' ?> pay-modes cheque cash">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"receiver_name","Placeholder"=>"Received By",
                                                                          "autocomplete"=>"off");
                                                        echo create_form_input("text","receiver_name","Received By",true,$booking['payment']['receiver_name']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 <?= $paymode=='online' ?'':'d-none' ?> pay-modes online">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"utr_no","Placeholder"=>"UTR No",
                                                                          "autocomplete"=>"off");
                                                        echo create_form_input("text","utr_no","UTR No",true,$booking['payment']['utr_no']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 <?= $paymode=='cheque' ?'':'d-none' ?> pay-modes cheque">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"cheque_no","Placeholder"=>"Cheque No",
                                                                          "autocomplete"=>"off");
                                                        echo create_form_input("text","cheque_no","Cheque No",true,$booking['payment']['cheque_no']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 <?= $paymode=='cheque' ?'':'d-none' ?> pay-modes cheque">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"cheque_date","Placeholder"=>"Cheque No",
                                                                          "autocomplete"=>"off");
                                                        echo create_form_input("date","cheque_date","Cheque Date",true,$booking['payment']['cheque_date']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 <?= $paymode=='cheque' || $paymode=='online' ?'':'d-none' ?> pay-modes online cheque">
                                                <div class="form-group">
                                                    <?php
                                                        if(empty($booking['payment']['screenshot'])){
                                                        $attributes=array("id"=>"screenshot","class"=>'form-control');
                                                        echo create_form_input("file","screenshot","Screenshot",true,'',$attributes); 
                                                        }
                                                        else{
                                                    ?>
                                                    <img src="<?= file_url($booking['payment']['screenshot']) ?>" alt="" height="300">
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"paid_amount","Placeholder"=>"Paid Amount",
                                                                          "autocomplete"=>"off",'step'=>'0.01');
                                                        echo create_form_input("number","paid_amount","Paid Amount",true,$booking['payment']['amount']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <?php
                                                if($f_type=='new'){
                                                ?>
                                                <button type="submit" class="btn btn-sm btn-success" name="savebooking">Save Booking</button>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?= form_close(); ?>
                                </div>

                                <!-- Step 2 -->
                                <div class="tab-pane fade" id="step2">
                                    <?php echo form_open_multipart('bookings/savebooking', 'id="kycform" onsubmit="return validate()"'); ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?php $b_for=$booking['booking_for']??'';  ?>
                                                <label for="">Booking For <span class="text-danger">*</span></label>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" id="bf_self" name="booking_for" value="Self" required <?= $b_for=='Self'?'checked':''; ?> >
                                                        <label for="bf_self">Self</label>
                                                    </div>
                                                    <div class="ml-2 icheck-success d-inline">
                                                        <input type="radio" id="bf_other" name="booking_for" value="Other" <?= $b_for=='Other'?'checked':''; ?> >
                                                        <label for="bf_other">Other</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"name","Placeholder"=>"Purchaser Name","autocomplete"=>"off",'data-value'=>$member['name']);
                                                        echo create_form_input("text","name","Purchaser Name",true,$booking['name']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"father","Placeholder"=>"Father/Husband Name","autocomplete"=>"off",'data-value'=>$member['father']);
                                                        echo create_form_input("text","father","Father/Husband Name",true,$booking['father']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"grand_father","Placeholder"=>"Grand Father Name","autocomplete"=>"off",'data-value'=>$member['grand_father']);
                                                        echo create_form_input("text","grand_father","Grand Father Name",true,$booking['grand_father']??'',$attributes); 
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
                                                                          "maxlength"=>"10",'data-value'=>$member['mobile']);
                                                        echo create_form_input("text","mobile","Mobile",true,$booking['mobile']??'',$attributes); 
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
                                                                          "maxlength"=>"10",'data-value'=>$member['a_mobile']);
                                                        echo create_form_input("text","a_mobile","Alternate Mobile",true,$booking['a_mobile']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"email","Placeholder"=>"Email",
                                                                          "autocomplete"=>"off",'data-value'=>$member['email']);
                                                        echo create_form_input("email","email","Email",false,$booking['email']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"address","Placeholder"=>"Address",
                                                                          "autocomplete"=>"off",'rows'=>3,'data-value'=>$member['address']);
                                                        echo create_form_input("textarea","address","Address",true,$booking['address']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"state_id",'class'=>'dropdowns','data-value'=>$member['state_id']??'');
                                                        echo create_form_input("select","state_id","State",true,$booking['state_id']??'',$attributes,state_dropdown()); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"district_id",'class'=>'dropdowns','data-value'=>$member['district_id']??'');
                                                        echo create_form_input("select","district_id","District",true,$booking['district_id']??'',$attributes,$districts??[''=>'Select District']); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"city_id",'class'=>'dropdowns city','data-value'=>$member['city_id']??'');
                                                        echo create_form_input("select","city_id","City",true,$booking['city_id']??'',$attributes,$cities??[''=>'Select City']); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"pincode","Placeholder"=>"Pincode",
                                                                          "autocomplete"=>"off",'data-value'=>$member['pincode']);
                                                        echo create_form_input("text","pincode","Pincode",true,$booking['pincode']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        if(empty($booking['photo'])){
                                                        $attributes=array("id"=>"photo","class"=>'form-control');
                                                        echo create_form_input("file","photo","Photo",true,'',$attributes); 
                                                        }
                                                        else{
                                                    ?>
                                                    <img src="<?= file_url($booking['photo']) ?>" alt="" height="300">
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="header smaller lighter">KYC Documents</h3>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"aadhar","Placeholder"=>"Aadhar No.",
                                                                          "pattern"=>"[0-9]{12}",
                                                                          "title"=>"Enter Valid Aadhar No.",
                                                                          "autocomplete"=>"off","maxlength"=>"12",
                                                                          'data-value'=>$member['aadhar']);
                                                        echo create_form_input("text","aadhar","Aadhar No.",true,$booking['kyc']['aadhar']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        if(empty($booking['kyc']['aadhar1'])){
                                                        $attributes=array("id"=>"aadhar1",'class'=>'form-control');
                                                        echo create_form_input("file","aadhar1","Aadhar Front Image",true,'',$attributes); 
                                                        }
                                                        else{
                                                    ?>
                                                    <img src="<?= file_url($booking['kyc']['aadhar1']) ?>" alt="" class="img-fluid">
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        if(empty($booking['kyc']['aadhar2'])){
                                                        $attributes=array("id"=>"aadhar2",'class'=>'form-control');
                                                        echo create_form_input("file","aadhar2","Aadhar Back Image",true,'',$attributes); 
                                                        }
                                                        else{
                                                    ?>
                                                    <img src="<?= file_url($booking['kyc']['aadhar2']) ?>" alt="" class="img-fluid">
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"pan","Placeholder"=>"PAN",
                                                                          "pattern"=>"[A-Za-z0-9]{10}",
                                                                          "title"=>"Enter Valid PAN",
                                                                          "autocomplete"=>"off","maxlength"=>"10",
                                                                          'data-value'=>$member['pan']);
                                                        echo create_form_input("text","pan","PAN",true,$booking['kyc']['pan']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        if(empty($booking['kyc']['pan_image'])){
                                                        $attributes=array("id"=>"pan_image",'class'=>'form-control');
                                                        echo create_form_input("file","pan_image","PAN Card Image",true,'',$attributes);
                                                        }
                                                        else{
                                                    ?>
                                                    <img src="<?= file_url($booking['kyc']['pan_image']) ?>" alt="" class="img-fluid">
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"voter_id","Placeholder"=>"Voter ID");
                                                        echo create_form_input("text","voter_id","Voter ID",false,$booking['kyc']['voter_id']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"driving_license","Placeholder"=>"Driving License No.");
                                                        echo create_form_input("text","driving_license","Driving License No.",false,$booking['kyc']['driving_license']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <?php
                                                if($f_type=='kyc'){
                                                ?>
                                                <input type="hidden" name="id" value="<?= md5('booking-id-'.$booking['id']) ?>">
                                                <button type="submit" class="btn btn-sm btn-success" name="savekycdetails">Save KYC Details</button>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?= form_close(); ?>
                                </div>

                                <!-- Step 3 -->
                                <div class="tab-pane fade" id="step3">
                                    <?php
                                    $nominee=$booking['nominee']??array();
                                    ?>
                                    <?php echo form_open_multipart('bookings/savebooking', 'id="nomineeform" onsubmit="return validate()"'); ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"nom_name","Placeholder"=>"Nominee Name","autocomplete"=>"off");
                                                        echo create_form_input("text","name","Nominee Name",true,$nominee['name']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"nom_father","Placeholder"=>"Father/Husband Name","autocomplete"=>"off");
                                                        echo create_form_input("text","father","Father/Husband Name",true,$nominee['name']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"nom_mobile","Placeholder"=>"Mobile",
                                                                          "autocomplete"=>"off","pattern"=>"[0-9]{10}",
                                                                          "title"=>"Enter Valid Mobile No.","maxlength"=>"10");
                                                        echo create_form_input("text","mobile","Mobile",true,
                                                                               $nominee['mobile']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"nom_email","Placeholder"=>"Email","autocomplete"=>"off");
                                                        echo create_form_input("email","email","Email",false,$nominee['email']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"nom_address","Placeholder"=>"Address","autocomplete"=>"off",'rows'=>3);
                                                        echo create_form_input("textarea","address","Address",true,$nominee['address']??'',$attributes); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                    ?>
                                                    <?php
                                                        if(empty($nominee['photo'])){
                                                        $attributes=array("id"=>"nom_photo",'class'=>'form-control');
                                                        echo create_form_input("file","photo","Nominee Photo",true,'',$attributes); 
                                                        }
                                                        else{
                                                    ?>
                                                    <img src="<?= file_url($nominee['photo']) ?>" alt="" class="img-fluid">
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <?php
                                                if($f_type=='nominee'){
                                                ?>
                                                <input type="hidden" name="id" value="<?= md5('booking-id-'.$booking['id']) ?>">
                                                <button type="submit" class="btn btn-sm btn-success" name="savenomineedetails">Save Nominee Details</button>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?= form_close(); ?>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function(){
                    $('body').on('change','#date',function(){
                        
                        let date=new Date($(this).val());
                        
                        if (!this.value) return;

                        // Add 7 days
                        date.setDate(date.getDate() + 7);

                        // Format to YYYY-MM-DD
                        let nextWeekDate = date.toISOString().split('T')[0];
                        $('#due_date').data('value',nextWeekDate);
                        if($('input[name="type"]:checked').val()=='hold'){
                            $('#due_date').val($('#due_date').data('value'));   
                        }
                    });
                    $('body').on('change','#project_id',function(){
                        var project_id=$(this).val();
                        $('#price,#other_price,#total_amount').val('');
                        $.post('<?= base_url('projects/getproject') ?>',{project_id:project_id},function(data){
                            if(data!='null'){
                                data=JSON.parse(data);
                                $('#price').val(data['price']);
                                $('#other_price').val(data['other_price']);
                                $('#total_amount').val(data['final_price']);
                            }
                        });
                        
                    });
                    $('body').on('change','input[name="type"]',function(){
                        var type=$('input[name="type"]:checked').val();
                        $('#due_date,#duration').parent().parent().addClass('d-none');
                        $('#payment_type,#paid_amount').val('');
                        $('#paid_amount').prop('readonly',false);
                        $('#payment_type option').show();
                        $('#due_date,#duration').val('');
                        if(type=='full_payment'){
                        }
                        else if(type=='emi'){
                            //$('#duration').parent().parent().removeClass('d-none');
                        }
                        else if(type=='hold'){
                            $('#due_date').val($('#due_date').data('value'));
                            $('#due_date').parent().parent().removeClass('d-none');
                            $('#payment_type option').hide();
                            $('#payment_type option[value="token"]').show();
                            $('#payment_type').val('token');
                            $('#paid_amount').val('11000');
                            $('#paid_amount').prop('readonly',true);
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
                    $('body').on('change','#payment_mode',function(){
                        let mode=$(this).val();
                        $('.pay-modes').addClass('d-none');
                        $('.pay-modes input').val('').prop('required',false);
                        if(mode=='cash'){
                            $('.pay-modes.cash').removeClass('d-none');
                            $('.pay-modes.cash input').prop('required',true);
                        }
                        else if(mode=='online'){
                            $('.pay-modes.online').removeClass('d-none');
                            $('.pay-modes.online input').prop('required',true);
                        }
                        else if(mode=='cheque'){
                            $('.pay-modes.cheque').removeClass('d-none');
                            $('.pay-modes.cheque input').prop('required',true);
                        }
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
                    $('body').on('change','input[name="booking_for"]',function(){
                        var booking_for=$('input[name="booking_for"]:checked').val();
                        console.log(booking_for);
                        let val='';
                        $('#kycform input.form-control').each(function(){
                            val='';
                            if(booking_for=='Self'){
                               val=$(this).attr('data-value');
                            }
                            $(this).val(val);
                        });
                    });
                    <?php
                    if($f_type=='kyc'){
                        echo "$('#kyc-link').click();";
                    }
                    elseif($f_type=='nominee'){
                        echo "$('#nominee-link').click();";
                    }
                    ?>
                    
                });
            </script>