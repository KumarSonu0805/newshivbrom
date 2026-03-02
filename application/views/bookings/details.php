<?php
$nominee=$booking['nominee'];
$details=$booking['details'];
$payment=$booking['payment'];
?>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $title; ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="header smaller lighter">Personal Information</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"ref","Placeholder"=>"Member ID","autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","","Member ID",true,$booking['member_id'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"refname","Placeholder"=>"Member Name","autocomplete"=>"off","readonly"=>true);
                                                echo create_form_input("text","","Member Name",true,$booking['member_name'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"","Placeholder"=>"Mobile","autocomplete"=>"off","readonly"=>true);
                                                echo create_form_input("text","","Mobile",true,$booking['member_mobile'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"name","Placeholder"=>"Purchaser Name","autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","name","Purchaser Name",true,$booking['name'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"father","Placeholder"=>"Father/Husband Name","autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","father","Father/Husband Name",true,$booking['father'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"grand_father","Placeholder"=>"Grand Father Name","autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","grand_father","Grand Father Name",true,$booking['grand_father'],$attributes); 
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
                                                                  "title"=>"Enter Valid Mobile No.","maxlength"=>"10",'readonly'=>'true');
                                                echo create_form_input("text","mobile","Mobile",true,$booking['mobile'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"a_mobile","Placeholder"=>"Alternate Mobile",
                                                                  "autocomplete"=>"off","pattern"=>"[0-9]{10}",
                                                                  "title"=>"Enter Valid Alternate Mobile No.","maxlength"=>"10",'readonly'=>'true');
                                                echo create_form_input("text","a_mobile","Alternate Mobile",false,$booking['a_mobile'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"email","Placeholder"=>"Email","autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("email","email","Email",false,$booking['email'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"aadhar","Placeholder"=>"Aadhar No.","pattern"=>"[0-9]{12}","title"=>"Enter Valid Aadhar No.","autocomplete"=>"off","maxlength"=>"12",'readonly'=>'true');
                                                echo create_form_input("text","aadhar","Aadhar No.",true,$booking['aadhar']??'',$attributes);  
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"voter_id","Placeholder"=>"Voter ID",
                                                                  "autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","voter_id","Voter ID",false,$booking['voter_id']??'',$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"driving_license",
                                                                  "Placeholder"=>"Driving License",
                                                                  "autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","driving_license","Driving License",false,$booking['driving_license']??'',$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"pan","Placeholder"=>"PAN No.","pattern"=>"[A-Za-z0-9]{10}","title"=>"Enter Valid Pan No.","autocomplete"=>"off","maxlength"=>"10",'readonly'=>'true');
                                                echo create_form_input("text","pan","PAN No.",false,$booking['pan']??'',$attributes);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"other_id","Placeholder"=>"Other ID Proof",
                                                                  "autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","other_id","Other ID Proof",false,$booking['other_id']??'',$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"address","Placeholder"=>"Address","autocomplete"=>"off",'rows'=>3,'readonly'=>'true');
                                                echo create_form_input("textarea","address","Address",true,$booking['address'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"state","Placeholder"=>"State",
                                                                  "autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","state","State",true,$booking['state'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"district","Placeholder"=>"District",
                                                                  "autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","district","District",true,$booking['district'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"city","Placeholder"=>"City",
                                                                  "autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","city","City",true,$booking['city'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"pincode","Placeholder"=>"Pincode",

                                                                  "autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","pincode","Pincode",true,$booking['pincode'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if(!empty($booking['photo'])){ ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <a href="<?= file_url($booking['photo']) ?>" class="btn btn-sm btn-info" target="_blank">View Photo</a>
                                        </div>
                                    </div>
                                    <?php }if(!empty($booking['passbook'])){ ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <a href="<?= file_url($booking['passbook']) ?>" class="btn btn-sm btn-info" target="_blank">View Passbook or Cancelled Cheque</a>
                                        </div>
                                    </div>
                                    <?php }if(!empty($booking['aadhar_image'])){ ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <a href="<?= file_url($booking['aadhar_image']) ?>" class="btn btn-sm btn-info" target="_blank">View Aadhar Image</a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div><hr>
                                <h3 class="header smaller lighter">Nominee Details</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"nom_name","Placeholder"=>"Nominee Name","autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","nom_name","Nominee Name",true,$nominee['name']??'',$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"nom_father","Placeholder"=>"Father/Husband Name","autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","nom_father","Father/Husband Name",true,$nominee['father']??'',$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"nom_mobile","Placeholder"=>"Mobile",
                                                                  "autocomplete"=>"off","pattern"=>"[0-9]{10}",
                                                                  "title"=>"Enter Valid Mobile No.","maxlength"=>"10",'readonly'=>'true');
                                                echo create_form_input("text","nom_mobile","Mobile",true,$nominee['mobile']??'',
                                                                       $attributes); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"nom_email","Placeholder"=>"Email","autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("email","nom_email","Email",false,$nominee['email']??'',$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"nom_address","Placeholder"=>"Address","autocomplete"=>"off",'rows'=>3,'readonly'=>'true');
                                                echo create_form_input("textarea","nom_address","Address",false,$nominee['address']??'',$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <?php if(!empty($nominee['photo'])){ ?>
                                    <div class="col-md-4">
                                        <div class="form-group"><br>
                                            <a href="<?= file_url($nominee['photo'])??file_url('assets/images/avatar.jpg') ?>" class="btn btn-sm btn-info" target="_blank">View Photo</a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div><hr>
                                <h3 class="header smaller lighter">Booking Information</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"b_type",'disabled'=>'true');
                                                echo create_form_input("select","b_type","Booking Type",true,$booking['booking_type'],$attributes,bookingtype_dropdown()); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"project_id",'disabled'=>'true');
                                                echo create_form_input("select","project_id","Project Name",true,$booking['project_id'],$attributes,project_dropdown()); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"plot_no","Placeholder"=>"Plot Number","autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","plot_no","Plot Number",true,$booking['plot_no'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"b_address","Placeholder"=>"Address","autocomplete"=>"off",'rows'=>3,'readonly'=>'true');
                                                echo create_form_input("textarea","b_address","Address",true,$booking['b_address'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"b_state","Placeholder"=>"State",
                                                                  "autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","b_state","State",true,$booking['b_state'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"b_district","Placeholder"=>"District",
                                                                  "autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","b_district","District",true,$booking['b_district'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"b_city","Placeholder"=>"City",
                                                                  "autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","b_city","City",true,$booking['b_city'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"landmark","Placeholder"=>"Landmark",
                                                                  "autocomplete"=>"off",'readonly'=>'true');
                                                echo create_form_input("text","landmark","Landmark",false,$booking['landmark'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"price","Placeholder"=>"Price",
                                                                  "autocomplete"=>"off",'step'=>'0.01','readonly'=>'true');
                                                echo create_form_input("number","price","Price",true,$booking['price'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"other_price","Placeholder"=>"Other Price",
                                                                  "autocomplete"=>"off",'step'=>'0.01','readonly'=>'true');
                                                echo create_form_input("number","other_price","Other Price",true,$booking['other_price'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"total_amount",'readonly'=>'true',
                                                                  "Placeholder"=>"Final Amount",
                                                                  "autocomplete"=>"off",'step'=>'0.01');
                                                echo create_form_input("number","total_amount","Final Amount",true,$booking['total_amount'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"payment_type",'disabled'=>'true');
                                                echo create_form_input("select","payment_type","Payment Type",true,$payment['payment_type'],$attributes,paymenttype_dropdown()); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"payment_date",'readonly'=>'true');
                                                echo create_form_input("date","payment_date","Payment Date",true,$payment['date'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"payment_mode",'disabled'=>'true');
                                                echo create_form_input("select","payment_mode","Payment Mode",true,$payment['payment_mode'],$attributes,paymentmode_dropdown()); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"paid_amount","Placeholder"=>"Paid Amount",
                                                                  "autocomplete"=>"off",'step'=>'0.01','readonly'=>'true');
                                                echo create_form_input("number","paid_amount","Paid Amount",true,$payment['amount'],$attributes); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
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