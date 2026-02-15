	
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title"><?= $title; ?></h4>
									
								</div>
								<div class="card-body">
                                    <?= form_open('members/generatemembers'); ?>
                                        <div class="form-group mb-0">
                                            <?php
                                                $attributes=array("id"=>"ref","Placeholder"=>"Reference ID","autocomplete"=>"off");
                                                echo create_form_input("text","","Reference ID",true,'',$attributes); 
                                                echo create_form_input("hidden","refid","",false,'',array("id"=>"refid"));  
                                            ?>
                                        </div>
                                        <div style="padding:0 10px; font-size:16px; font-weight:600; clear:both;" class=" mb-3" id="refdiv"></div>
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"position");
                                                $positions=array(''=>'Select','L'=>'Left','R'=>'Right');//,'auto'=>'Left to Right');
                                                echo create_form_input("select","position","Position",true,'',$attributes,$positions);  
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                                $attributes=array("id"=>"count","Placeholder"=>"No of IDs","autocomplete"=>"off");
                                                echo create_form_input("text","count","No of IDs",true,'',$attributes);  
                                            ?>
                                        </div>
                                        <button type="submit" name="generatemembers" class="btn btn-sm btn-success">Generate Members</button>
                                    <?= form_close(); ?>
								</div>
							</div>
						</div>
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

                function validate(){
                    $('#savebtn').hide();
                }
            </script>