<?php
    $button ='<input type="hidden" name="regid" value="'.$member['regid'].'">';
    $button.='<button type="submit" name="updatemember" class="btn btn-sm btn-success">Update Member</button>';
    $button.=' <a href="'.base_url('members/memberlist/').'" class="btn btn-sm btn-danger">Cancel</a>';
?>
<style>
    .img-preview{
        height: 150px;
        width: 250px;
    }
    .cheque-preview{
        height: 150px;
        width: 120px;
    }
</style>
                    <div class="col-12" id="accordion">
                        <div class="card card-primary card-outline">
                            <a class="d-block w-100" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Edit Personal Details
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseOne" class="collapse show" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <?= form_open('members/updatemember'); ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"name","Placeholder"=>"Full Name","autocomplete"=>"off");
                                                        echo create_form_input("text","name","Name",true,$member['name'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"mobile","Placeholder"=>"Mobile","autocomplete"=>"off","pattern"=>"[0-9]{10}","title"=>"Enter Valid Mobile No.","maxlength"=>"10");
                                                        echo create_form_input("text","mobile","Mobile",true,$member['mobile'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"email","Placeholder"=>"Email","autocomplete"=>"off");
                                                        echo create_form_input("email","email","Email",false,$member['email'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        echo create_form_input("date","dob","Date Of Birth",true,$member['dob'],array("id"=>"dob"));  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"aadhar","Placeholder"=>"Aadhar No.","pattern"=>"[0-9]{12}","title"=>"Enter Valid Aadhar No.","autocomplete"=>"off","maxlength"=>"12");
                                                        echo create_form_input("text","aadhar","Aadhar No.",true,$member['aadhar'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"pan","Placeholder"=>"PAN No.","pattern"=>"[A-Za-z0-9]{10}","title"=>"Enter Valid Pan No.","autocomplete"=>"off","maxlength"=>"10");
                                                        echo create_form_input("text","pan","PAN No.",false,$member['pan'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                   <?php
                                                        $attributes=array("id"=>"father","Placeholder"=>"Father's Name","autocomplete"=>"off");
                                                        echo create_form_input("text","father","Father's Name",false,$member['father'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                   <?php
                                                        $attributes=array("id"=>"mother","Placeholder"=>"Mother's Name","autocomplete"=>"off");
                                                        echo create_form_input("text","mother","Mother's Name",false,$member['mother'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                   <?php
                                                        $attributes=array("id"=>"occupation","Placeholder"=>"Occupation","autocomplete"=>"off");
                                                        echo create_form_input("text","occupation","Occupation",false,$member['occupation'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                   <?php
                                                        $attributes=array("id"=>"qualification","Placeholder"=>"Qualification","autocomplete"=>"off");
                                                        echo create_form_input("text","qualification","Qualification",false,$member['qualification'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                   <?php
                                                        $attributes=array("id"=>"a_income","Placeholder"=>"Annual Income","autocomplete"=>"off");
                                                        echo create_form_input("text","a_income","Annual Income",false,$member['a_income'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $mstatus=array(""=>"Select","Married"=>"Married","Unmarried"=>"Unmarried");
                                                        echo create_form_input("select","mstatus","Marital Status",false,$member['mstatus'],array("id"=>"mstatus"),$mstatus); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $gender=array(""=>"Select Gender","Male"=>"Male","Female"=>"Female");
                                                        echo create_form_input("select","gender","Gender",false,$member['gender'],array("id"=>"gender"),$gender); 
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"address","Placeholder"=>"Address","autocomplete"=>"off","rows"=>"3");
                                                        echo create_form_input("textarea","address","Address",false,$member['address'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"district","Placeholder"=>"District","autocomplete"=>"off");
                                                        echo create_form_input("text","district","District",false,$member['district'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"state","Placeholder"=>"State","autocomplete"=>"off");
                                                        echo create_form_input("text","state","State",false,$member['state'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"pob","Placeholder"=>"Place of Birth","autocomplete"=>"off");
                                                        echo create_form_input("text","pob","Place of Birth",false,$member['pob'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"govt_service","Placeholder"=>"Govt. Service (Years)","autocomplete"=>"off");
                                                        echo create_form_input("text","govt_service","Govt. Service (Years)",false,$member['govt_service'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"height","Placeholder"=>"Height","autocomplete"=>"off");
                                                        echo create_form_input("text","height","Height",false,$member['height'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"weight","Placeholder"=>"Weight","autocomplete"=>"off");
                                                        echo create_form_input("text","weight","Weight",false,$member['weight'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"i_mark","Placeholder"=>"Identification Mark","autocomplete"=>"off");
                                                        echo create_form_input("text","i_mark","Identification Mark",false,$member['i_mark'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 <?= $member['status']==0?'d-none':'' ?>">
                                                <div class="form-group">
                                                    <?php
                                                        $attributes=array("id"=>"policy_no","Placeholder"=>"Policy Number","autocomplete"=>"off");
                                                        echo create_form_input("text","policy_no","Policy Number",false,$member['policy_no'],$attributes);  
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                
                                                <?= $button; ?>
                                            </div>
                                        </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Account Details
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <?php                                    
                                        $button ='<input type="hidden" name="regid" value="'.$member['regid'].'">';
                                        $button.='<button type="submit" name="updatemember" class="btn btn-sm btn-success">Update Account Details</button>';
                                        $button.=' <a href="'.base_url('members/memberlist/').'" class="btn btn-sm btn-danger">Cancel</a>';
                                    ?>
                                    <?= form_open('members/updatemember'); ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('select','bank','Bank',true,$acc_details['bank']??'',array('id'=>'bank'),$banks); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('text','branch','Branch',true,$acc_details['branch']??'',array('id'=>'branch')); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('text','account_no','A/C Number',true,$acc_details['account_no']??'',array('id'=>'account_no')); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('text','account_name','A/C Holder Name',true,$acc_details['account_name']??'',array('id'=>'account_name')); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('text','ifsc','IFSC',true,$acc_details['ifsc']??'',array('id'=>'ifsc')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                
                                                <?= $button; ?>
                                            </div>
                                        </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Nominee Details
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseThree" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <?php                                    
                                        $button ='<input type="hidden" name="regid" value="'.$member['regid'].'">';
                                        $button.='<button type="submit" name="updatenominee" class="btn btn-sm btn-success">Update Nominee Details</button>';
                                        $button.=' <a href="'.base_url('members/memberlist/').'" class="btn btn-sm btn-danger">Cancel</a>';
                                    ?>
                                    <?= form_open('members/updatenominee'); ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('text','name','Nominee Name',true,$nominee_details['name']??'',array('id'=>'name')); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('text','age','Nominee Age',true,$nominee_details['age']??'',array('id'=>'age')); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('select','relation','Relation',true,$nominee_details['relation']??'',array('id'=>'relation'),$relations); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                
                                                <?= $button; ?>
                                            </div>
                                        </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Update Password
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseFour" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <?php                                    
                                        $button ='<input type="hidden" name="regid" value="'.$member['regid'].'">';
                                        $button.='<button type="submit" name="updatepassword" class="btn btn-sm btn-success">Update Password</button>';
                                        $button.=' <a href="'.base_url('members/memberlist/').'" class="btn btn-sm btn-danger">Cancel</a>';
                                    ?>
                                    <?= form_open('members/updatepassword','onSubmit="return validatePassword();"'); ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('password','password','New Password',true,'',array('id'=>'password')); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('password','retype','Re-Type Password',true,'',array('id'=>'retype')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                
                                                <?= $button; ?>
                                            </div>
                                        </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseSeven" aria-expanded="false">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Update KYC Documents
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseSeven" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <?php                                    
                                        $button ='<input type="hidden" name="regid" value="'.$member['regid'].'">';
                                        $button.='<button type="submit" name="updatedocs" class="btn btn-sm btn-success">Update KYC Documents</button>';
                                        $button.=' <a href="'.base_url('members/memberlist/').'" class="btn btn-sm btn-danger">Cancel</a>';
                                    ?>
                                    <?= form_open_multipart('members/updatedocs',''); ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('file','aadhar1','Aadhar Front',true,'',array('id'=>'aadhar1','onChange'=>"getPhoto(this,'aadhar1')")); ?>
                                                    <img <?= !empty($acc_details['aadhar1'])?'src="'.file_url($acc_details['aadhar1']).'"':''; ?> id="aadhar1-preview" class="img-preview">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('file','aadhar2','Aadhar Back',true,'',array('id'=>'aadhar2','onChange'=>"getPhoto(this,'aadhar2')")); ?>
                                                    <img <?= !empty($acc_details['aadhar2'])?'src="'.file_url($acc_details['aadhar2']).'"':''; ?> id="aadhar2-preview" class="img-preview">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('file','pan','PAN',true,'',array('id'=>'panimg','onChange'=>"getPhoto(this,'panimg')")); ?>
                                                    <img <?= !empty($acc_details['pan'])?'src="'.file_url($acc_details['pan']).'"':''; ?> id="panimg-preview" class="img-preview">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?= create_form_input('file','cheque','Bank Passbook',true,'',array('id'=>'cheque','onChange'=>"getPhoto(this,'cheque')")); ?>
                                                    <img <?= !empty($acc_details['cheque'])?'src="'.file_url($acc_details['cheque']).'"':''; ?> id="cheque-preview"  class="img-preview">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="hidden" name="name" value="<?= $member['name'] ?>">
                                                <?= $button; ?>
                                            </div>
                                        </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseEight" aria-expanded="false">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Update Family
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseEight" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <?php                                    
                                        $button ='<input type="hidden" name="regid" value="'.$member['regid'].'">';
                                        $button.='<button type="submit" name="updatefamily" class="btn btn-sm btn-success">Update KYC Documents</button>';
                                        $button.=' <a href="'.base_url('members/memberlist/').'" class="btn btn-sm btn-danger">Cancel</a>';
                                    ?>
                                    <?= form_open_multipart('members/updatefamily',''); ?>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Relation</th>
                                                                <th>Living/Dead</th>
                                                                <th>Age</th>
                                                                <th>Health</th>
                                                                <th>Death Date</th>
                                                                <th>Type of Death</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $rels=empty($family_details)?array():array_column($family_details,'relation');
                                                                $relations=relation_dropdown();
                                                                foreach($relations as $key=>$relation){
                                                                    if($key==''){continue;}
                                                                    $index=array_search($relation,$rels);
                                                                    $index=$index===false?-1:$index;
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php
                                                                        $attributes=array('readonly'=>'readonly');
                                                                        echo create_form_input("text","relations[]","",false,$relation,$attributes);  
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        $attributes=array();
                                                                        echo create_form_input("select","status[]","",false,$family_details[$index]['status']??'',$attributes,[''=>'Select','Living'=>'Living','Dead'=>'Dead']);  
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        $attributes=array();
                                                                        echo create_form_input("text","age[]","",false,$family_details[$index]['age']??'',$attributes);  
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        $attributes=array();
                                                                        echo create_form_input("select","health[]","",false,$family_details[$index]['status']??'Good',$attributes,['Good'=>'Good','Bad'=>'Bad']);  
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        $attributes=array();
                                                                        echo create_form_input("date","death_date[]","",false,$family_details[$index]['death_date']??'',$attributes);  
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        $attributes=array();
                                                                        echo create_form_input("text","type_of_death[]","",false,$family_details[$index]['type_of_death']??'',$attributes);  
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <?= $button; ?>
                                            </div>
                                        </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                    </div>

                                    <script>
                                        $(document).ready(function(){
                                            $('body').on('change','#type',function(){
                                                var cls=$(this).val();
                                                $('.dropdowns').closest('.col-md-4').addClass('d-none');
                                                $('.dropdowns').prop('required',false);
                                                if(cls!=''){
                                                    $('.'+cls).closest('.col-md-4').removeClass('d-none');
                                                    $('.'+cls).prop('required',true);
                                                }
                                            });
                                            $('body').on('change','#state_id',function(){
                                                var district_id=$(this).attr('data-district_id');
                                                $.ajax({
                                                    type:"post",
                                                    url:"<?= base_url('masterkey/getdistrictdropdown/'); ?>",
                                                    data:{state_id:$(this).val(),district_id:district_id},
                                                    success:function(data){
                                                        $('#district_id').replaceWith(data);
                                                        $('#district_id').addClass('district area dropdowns');
                                                        if($('#type').val()=='state'){
                                                            $('#district_id').prop('required',false);
                                                        }
                                                    }
                                                });
                                            });
                                            $('body').on('change','#district_id',function(){
                                                var area_id=$(this).attr('data-area_id');
                                                $.ajax({
                                                    type:"post",
                                                    url:"<?= base_url('masterkey/getareadropdown/'); ?>",
                                                    data:{district_id:$(this).val(),area_id:area_id},
                                                    success:function(data){
                                                        $('#area_id').replaceWith(data);
                                                        if($('#type').val()!='area'){
                                                            $('#area_id').prop('required',false);
                                                        }
                                                    }
                                                });
                                            });
                                        });
                                        function getPhoto(input,id){
                                            var cls=id=='selfie'?'selfie-preview':'img-preview';
                                            if (input.files && input.files[0]) {
                                                var filename=input.files[0].name;
                                                var re = /(?:\.([^.]+))?$/;
                                                var ext = re.exec(filename)[1]; 
                                                if(ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='webp'){
                                                    var size=input.files[0].size;
                                                    if(size<=10240000){
                                                        var reader = new FileReader();
                                                        //alert(input.files[0].size);
                                                        reader.onload = function (e) {
                                                            document.getElementById(id+"-preview").src= e.target.result;
                                                        }
                                                        reader.readAsDataURL(input.files[0]);
                                                    }
                                                    else if(size>=10240000){
                                                        document.getElementById(id).value= null;
                                                        alert("Image size is greater than 100MB");	
                                                        $('#'+id+'-preview').replaceWith('<img id="'+id+'-preview" alt="" class="'+cls+'">');
                                                    }
                                                }
                                                else{
                                                    document.getElementById(id).value= null;
                                                    alert("Select 'jpeg' or 'jpg' or 'png' image file!!");	
                                                    $('#'+id+'-preview').replaceWith('<img id="'+id+'-preview" alt="" class="'+cls+'">');
                                                }
                                            }
                                            else{
                                                $('#'+id+'-preview').replaceWith('<img id="'+id+'-preview" alt="" class="'+cls+'">');
                                            }
                                        }
                                        function validatePassword(){
                                            var password=$('#password').val();
                                            var repassword=$('#retype').val();
                                            if(password!=repassword){
                                                alert('Passwords Do not Match!');
                                                return false;
                                            }
                                        }
                                        function validateLoginPin(){
                                            var password=$('#pin').val();
                                            var repassword=$('#retype-lp').val();
                                            if(password!=repassword){
                                                alert('Login PINs Do not Match!');
                                                return false;
                                            }
                                        }
                                        function validateTransactionPin(){
                                            var password=$('#t_pin').val();
                                            var repassword=$('#retype-tp').val();
                                            if(password!=repassword){
                                                alert('Login PINs Do not Match!');
                                                return false;
                                            }
                                        }
                                    </script>