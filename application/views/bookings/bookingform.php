
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $title; ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <?php echo form_open_multipart('bookings/savebooking', 'id="myform" onsubmit="return validate()"'); ?>
                                    <h3 class="header smaller lighter">Personal Information</h3>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"ref","Placeholder"=>"Member ID","autocomplete"=>"off",'readonly'=>'true');
                                                    echo create_form_input("text","","Member ID",true,$user['username'],$attributes); 
                                                    echo create_form_input("hidden","regid","",false,$user['id'],array("id"=>"regid")); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"refname","Placeholder"=>"Member Name","autocomplete"=>"off","readonly"=>true);
                                                    echo create_form_input("text","","Member Name",true,$user['name'],$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"","Placeholder"=>"Mobile","autocomplete"=>"off","readonly"=>true);
                                                    echo create_form_input("text","","Mobile",true,$user['mobile'],$attributes); 
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
                                                                      "title"=>"Enter Valid Mobile No.","maxlength"=>"10");
                                                    echo create_form_input("text","mobile","Mobile",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"a_mobile","Placeholder"=>"Alternate Mobile",
                                                                      "autocomplete"=>"off","pattern"=>"[0-9]{10}",
                                                                      "title"=>"Enter Valid Alternate Mobile No.","maxlength"=>"10");
                                                    echo create_form_input("text","a_mobile","Alternate Mobile",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"email","Placeholder"=>"Email","autocomplete"=>"off");
                                                    echo create_form_input("email","email","Email",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"aadhar","Placeholder"=>"Aadhar No.","pattern"=>"[0-9]{12}","title"=>"Enter Valid Aadhar No.","autocomplete"=>"off","maxlength"=>"12");
                                                    echo create_form_input("text","aadhar","Aadhar No.",true,'',$attributes);  
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"voter_id","Placeholder"=>"Voter ID",
                                                                      "autocomplete"=>"off");
                                                    echo create_form_input("text","voter_id","Voter ID",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"driving_license",
                                                                      "Placeholder"=>"Driving License",
                                                                      "autocomplete"=>"off");
                                                    echo create_form_input("text","driving_license","Driving License",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"pan","Placeholder"=>"PAN No.","pattern"=>"[A-Za-z0-9]{10}","title"=>"Enter Valid Pan No.","autocomplete"=>"off","maxlength"=>"10");
                                                    echo create_form_input("text","pan","PAN No.",false,'',$attributes);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"other_id","Placeholder"=>"Other ID Proof",
                                                                      "autocomplete"=>"off");
                                                    echo create_form_input("text","other_id","Other ID Proof",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"address","Placeholder"=>"Address","autocomplete"=>"off",'rows'=>3);
                                                    echo create_form_input("textarea","address","Address",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"city","Placeholder"=>"City",
                                                                      "autocomplete"=>"off");
                                                    echo create_form_input("text","city","City",true,'',$attributes); 
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"photo",'class'=>'form-control');
                                                    echo create_form_input("file","photo","Photo",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"passbook",'class'=>'form-control');
                                                    echo create_form_input("file","passbook","Passbook or Cancelled Cheque",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"aadhar_image",'class'=>'form-control');
                                                    echo create_form_input("file","aadhar_image","Aadhar Image",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div><hr>
                                    <h3 class="header smaller lighter">Nominee Details</h3>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"nom_name","Placeholder"=>"Nominee Name","autocomplete"=>"off");
                                                    echo create_form_input("text","nom_name","Nominee Name",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"nom_father","Placeholder"=>"Father/Husband Name","autocomplete"=>"off");
                                                    echo create_form_input("text","nom_father","Father/Husband Name",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"nom_mobile","Placeholder"=>"Mobile",
                                                                      "autocomplete"=>"off","pattern"=>"[0-9]{10}",
                                                                      "title"=>"Enter Valid Mobile No.","maxlength"=>"10");
                                                    echo create_form_input("text","nom_mobile","Mobile",true,'',
                                                                           $attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"nom_email","Placeholder"=>"Email","autocomplete"=>"off");
                                                    echo create_form_input("email","nom_email","Email",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"nom_address","Placeholder"=>"Address","autocomplete"=>"off",'rows'=>3);
                                                    echo create_form_input("textarea","nom_address","Address",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"nom_photo",'class'=>'form-control');
                                                    echo create_form_input("file","nom_photo","Nominee Photo",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div><hr>
                                    <h3 class="header smaller lighter">Booking Information</h3>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"b_type");
                                                    $types=array(''=>'Select','land'=>'Land Booking');
                                                    echo create_form_input("select","b_type","Booking Type",true,'',$attributes,$types); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"project_id");
                                                    $projects=array(''=>'Select','1'=>'Vaidik Vihar');
                                                    echo create_form_input("select","project_id","Project Name",true,'',$attributes,$projects); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"plot_number","Placeholder"=>"Plot Number","autocomplete"=>"off");
                                                    echo create_form_input("text","plot_number","Plot Number",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"payment_type");
                                                    $payment_types=array(''=>'Select','full'=>'Full Payment','partial'=>'Partial Payment','emi'=>'EMI Payment');
                                                    echo create_form_input("select","payment_type","Payment Type",true,'',$attributes,$payment_types); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"price","Placeholder"=>"Price","autocomplete"=>"off",'step'=>'0.01');
                                                    echo create_form_input("number","price","Price",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"other_price","Placeholder"=>"Other Price","autocomplete"=>"off",'step'=>'0.01');
                                                    echo create_form_input("number","other_price","Other Price",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"total_amount","Placeholder"=>"Final Amount","autocomplete"=>"off",'step'=>'0.01','readonly'=>'true');
                                                    echo create_form_input("number","total_amount","Final Amount",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"token_amount","Placeholder"=>"Token Amount","autocomplete"=>"off",'step'=>'0.01');
                                                    echo create_form_input("number","token_amount","Token Amount",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"payment_mode");
                                                    $payment_modes=array(''=>'Select','cash'=>'Cash','online'=>'Online',
                                                                         'cheque'=>'Cheque');
                                                    echo create_form_input("select","payment_mode","Payment Type",true,'',$attributes,$payment_modes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"b_address","Placeholder"=>"Booking Address","autocomplete"=>"off",'rows'=>3);
                                                    echo create_form_input("textarea","b_address","Booking Address",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"b_city","Placeholder"=>"City","autocomplete"=>"off");
                                                    echo create_form_input("text","b_city","City",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"landmark","Placeholder"=>"Landmark","autocomplete"=>"off");
                                                    echo create_form_input("text","landmark","Landmark",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"document",'class'=>'form-control');
                                                    echo create_form_input("file","document","Other Document",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-sm btn-success" id="savebtn" name="savebooking">Save Booking</button>
                                        </div>
                                    </div>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function(){
                    $('body').on('keyup','#price,#other_price',function(){
                        var price=Number($('#price').val());
                        price=isNaN(price)?0:price;
                        var other_price=Number($('#other_price').val());
                        other_price=isNaN(other_price)?0:other_price;
                        var total=price+other_price;
                        $('#total_amount').val(total);
                    });
                });
            </script>