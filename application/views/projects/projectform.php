
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $title; ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <?php echo form_open_multipart('projects/saveproject', 'id="myform" onsubmit="return validate()"'); ?>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"name","Placeholder"=>"Project Title","autocomplete"=>"off");
                                                    echo create_form_input("text","name","Project Title",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"type");
                                                    echo create_form_input("select","type","Project Type",true,'',$attributes,projecttype_dropdown()); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"address","Placeholder"=>"Location",
                                                                      "autocomplete"=>"off","rows"=>8);
                                                    echo create_form_input("textarea","address","Location",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <?php
                                                            $attributes=array("id"=>"state_id",'class'=>'dropdowns');
                                                            echo create_form_input("select","state_id","State",true,$booking['state_id']??'',$attributes,state_dropdown()); 
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <?php
                                                            $attributes=array("id"=>"district_id",'class'=>'dropdowns');
                                                            echo create_form_input("select","district_id","District",true,$booking['district_id']??'',$attributes,$districts??[''=>'Select District']); 
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <?php
                                                            $attributes=array("id"=>"city_id",'class'=>'dropdowns city');
                                                            echo create_form_input("select","city_id","City",true,$booking['city_id']??'',$attributes,$b_cities??[''=>'Select City']); 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"overview","Placeholder"=>"Project Overview",
                                                                      "autocomplete"=>"off","rows"=>4);
                                                    echo create_form_input("textarea","overview","Project Overview",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"project_status");
                                                    echo create_form_input("select","project_status","Project Status",true,'',$attributes,projectstatus_dropdown()); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"property_type");
                                                    echo create_form_input("select","property_type","Property Type",true,'',$attributes,propertytype_dropdown()); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"price",'min'=>0);
                                                    echo create_form_input("number","price","Price",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"thumbnail_image",'class'=>'form-control');
                                                    echo create_form_input("file","thumbnail_image","Thumbnail Image",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"property_images",'class'=>'form-control','multiple'=>'true');
                                                    echo create_form_input("file","property_images[]","Property Images",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"brochure",'class'=>'form-control');
                                                    echo create_form_input("file","brochure","Project Brochure(PDF)",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
          
                                    <h4 class="lead">Other Informations</h4>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"planning_plot_area");
                                                    echo create_form_input("text","planning_plot_area","Planning Plot Area",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"running_plot_area");
                                                    echo create_form_input("text","running_plot_area","Running Plot Area",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"plot_size");
                                                    echo create_form_input("text","plot_size","Plot Size",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"plot_size_decimal");
                                                    echo create_form_input("text","plot_size_decimal","Plot Size (Decimal)",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"plot_name");
                                                    echo create_form_input("text","plot_name","Plot Name",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"village_map",'class'=>'form-control');
                                                    echo create_form_input("file","village_map","Government Village Map",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"plot_paper",'class'=>'form-control');
                                                    echo create_form_input("file","plot_paper","Plot Paper",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"plot_no");
                                                    echo create_form_input("text","plot_no","Plot No",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"khata_no");
                                                    echo create_form_input("text","khata_no","Khata No",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"khesra_no");
                                                    echo create_form_input("text","khesra_no","Khesra No",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"thana_no");
                                                    echo create_form_input("text","thana_no","Thana No",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"anchal");
                                                    echo create_form_input("text","anchal","Anchal",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"halka_no");
                                                    echo create_form_input("text","halka_no","Halka No",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"mouja_name");
                                                    echo create_form_input("text","mouja_name","Mouja Name",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"zila_name");
                                                    echo create_form_input("text","zila_name","Zila Name",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"jharbhumi_link");
                                                    echo create_form_input("text","jharbhumi_link","Jharbhumi Link",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"is_corner_plot");
                                                    echo create_form_input("select","is_corner_plot","Corner Plot",false,'',$attributes,['no'=>'No','yes'=>'Yes']); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-none">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"corner_extra_percentage",'min'=>0,'step'=>'0.01');
                                                    echo create_form_input("number","corner_extra_percentage","Corner Extra(%)",false,'0',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"has_amenities");
                                                    echo create_form_input("select","has_amenities","Amenities",false,'',$attributes,['no'=>'No','yes'=>'Yes']); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-none">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"amenities_facing",'multiple'=>'true');
                                                    echo create_form_input("select","amenities_facing[]","Amenities Facing",false,'',$attributes,amenities_dropdown()); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-none">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"amenities_percent",'min'=>0,'step'=>'0.01');
                                                    echo create_form_input("number","amenities_percent","Amenities(%)",false,'0',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"property_facing");
                                                    echo create_form_input("text","property_facing","Property Facing",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"distance");
                                                    echo create_form_input("text","distance","Distance",false,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"p_price",'readonly'=>'true');
                                                    echo create_form_input("number","","Price",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"other_price",'readonly'=>'true');
                                                    echo create_form_input("number","","Other Price",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"discount",'step'=>'0.01');
                                                    echo create_form_input("number","discount","Discount(%)",true,'0',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    $attributes=array("id"=>"final_price",'readonly'=>'true','step'=>'0.01');
                                                    echo create_form_input("number","final_price","Final Price",true,'',$attributes); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-sm btn-success" id="savebtn" name="saveproject">Save Project</button>
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
                    $('body').on('change','#is_corner_plot',function(){
                        $('#corner_extra_percentage').val(0);
                        if($(this).val()=='yes'){
                            $('#corner_extra_percentage').closest('.col-md-3').removeClass('d-none');
                        }
                        else{
                            $('#corner_extra_percentage').closest('.col-md-3').addClass('d-none');
                        }
                    });
                    $('body').on('change','#has_amenities',function(){
                        $('#amenities_percent').val(0);
                        $('#amenities_facing').val('');
                        if($(this).val()=='yes'){
                            $('#amenities_percent,#amenities_facing').closest('.col-md-3').removeClass('d-none');
                        }
                        else{
                            $('#amenities_percent,#amenities_facing').closest('.col-md-3').addClass('d-none');
                        }
                    });
                    
                    $('body').on('keyup','#price,#corner_extra_percentage,#amenities_percent,#discount',function(){
                        calculatePrice();
                    });
                });
                
                function calculatePrice(){
                    var price=Number($('#price').val());
                    price=isNaN(price)?0:price;
                    
                    var corner_percent=Number($('#corner_extra_percentage').val());
                    corner_percent=isNaN(corner_percent)?0:corner_percent;
                    var corner_cost=corner_percent*price/100;
                    
                    var amenities_percent=Number($('#amenities_percent').val());
                    amenities_percent=isNaN(amenities_percent)?0:amenities_percent;
                    var amenities_cost=amenities_percent*price/100;
                    var other_price=corner_cost+amenities_cost;
                    
                    var discount=Number($('#discount').val());
                    discount=isNaN(discount)?0:discount;
                    
                    var final_price=price+other_price;
                    final_price-=(final_price*discount)/100;
                    
                    $('#p_price').val(price);
                    $('#other_price').val(other_price);
                    $('#final_price').val(final_price);
                }
            </script>