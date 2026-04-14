	
                            <div class="col-md-12">
                                <div class="card light-bg">
                                    <div class="card-header">
                                        <h3 class="card-title"><?= $title ?></h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-striped data-table" id="bootstrap-data-table-export">
                                                    <thead>
                                                        <tr>
                                                            <th>Sl No.</th>
                                                            <th>Registration No</th>
                                                            <th>Name</th>
                                                            <th>Mobile</th>
                                                            <th>Type</th>
                                                            <th>Paid Amount</th>
                                                            <th>Booking Type</th>
                                                            <th>Payment</th>
                                                            <th>Payment Mode</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th>Booking Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $bookings=$bookings;
                                                            $btypes=bookingtype_dropdown();
                                                            $projects=project_dropdown();
                                                            $ptypes=paymenttype_dropdown();
                                                            $pmodes=paymentmode_dropdown();
                                                            if(is_array($bookings)){$i=0;
                                                                foreach($bookings as $booking){
                                                                    $i++;
                                                                    $type='';
                                                                    if($booking['type']=='full_payment'){
                                                                        $type='Full Payment';
                                                                    }
                                                                    elseif($booking['type']=='emi'){
                                                                        $type='EMI';
                                                                    }
                                                                    elseif($booking['type']=='hold'){
                                                                        $type='Hold';
                                                                    }
                                                                    
                                                                    $payment_type=$ptypes[$booking['payment_type']];
                                                                    $a_status="<span class='text-danger'>In-Active</span>";
                                                                    if($booking['a_status']==1){
                                                                        $a_status="<span class='text-success'>Active</span>";
                                                                    }
                                                                    $status="<span class='text-danger'>Pending</span>";
                                                                    if($booking['status']==1){
                                                                        $status="<span class='text-success'>Approved</span>";
                                                                    }
                                                        ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td><?= $booking['member_id']; ?></td>
                                                            <td><?= $booking['member_name']; ?></td>
                                                            <td><?= $booking['member_mobile']; ?></td>
                                                            <td><?= $type; ?></td>
                                                            <td><?= $booking['amount']; ?></td>
                                                            <td><?= $btypes[$booking['booking_type']]; ?></td>
                                                            <td><?= $payment_type; ?></td>
                                                            <td><?= ucfirst($booking['payment_mode']); ?></td>
                                                            <td><?= $a_status; ?></td>
                                                            <td><?= date('d-m-Y',strtotime($booking['added_on'])); ?></td>
                                                            <td><?= $status; ?></td>
                                                            <td>
                                                                <button type="button" data-toggle="modal" data-target="#mediumModal" class="btn btn-sm  btn-info view" value="<?= md5('payment-id-'.$booking['id']) ?>"><i class="fa fa-eye"></i></button>
                                                                <?php
                                                                    if(false && $this->session->role=='admin' && $booking['status']==0 && !empty($booking['name']) && !empty($booking['nominee_name'])){
                                                                ?>
                                                                <button type="button" value="<?= md5('booking-id-'.$booking['id']) ?>" class="btn btn-sm btn-success approve">Approve Booking</button>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pull-left" id="mediumModalLabel">Payment Details</h5>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body loader">
                <img src="<?= file_url('assets/images/loader.gif'); ?>" alt="loader">
            </div>
            <div class="modal-body d-none">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                                $attributes=array("id"=>"price","Placeholder"=>"Price",'readonly'=>'true',
                                                  "autocomplete"=>"off",'step'=>'0.01');
                                echo create_form_input("number","price","Price",true,'',$attributes); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                                $attributes=array("id"=>"other_price","Placeholder"=>"Other Price",'readonly'=>'true',
                                                  "autocomplete"=>"off",'step'=>'0.01');
                                echo create_form_input("number","other_price","Other Price",true,0,$attributes); 
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
                                echo create_form_input("select","payment_type","Payment Type",true,$booking['payment']['payment_type']??'',$attributes,paymenttype_dropdown()); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                                $attributes=array('readonly'=>'true',"id"=>"payment_date");
                                echo create_form_input("date","payment_date","Payment Date",true,'',$attributes); 
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
                <?php $paymode=$booking['payment']['payment_mode']??''; ?>
                <div class="row">
                    <div class="col-md-4 <?= $paymode=='cheque' || $paymode=='cash' ?'':'d-none' ?> pay-modes cheque cash">
                        <div class="form-group">
                            <?php
                                $attributes=array("id"=>"receiver_name","Placeholder"=>"Received By",'readonly'=>'true',
                                                  "autocomplete"=>"off");
                                echo create_form_input("text","receiver_name","Received By",true,$booking['payment']['receiver_name']??'',$attributes); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4 <?= $paymode=='online' ?'':'d-none' ?> pay-modes online">
                        <div class="form-group">
                            <?php
                                $attributes=array("id"=>"utr_no","Placeholder"=>"UTR No",'readonly'=>'true',
                                                  "autocomplete"=>"off");
                                echo create_form_input("text","utr_no","UTR No",true,$booking['payment']['utr_no']??'',$attributes); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4 <?= $paymode=='cheque' ?'':'d-none' ?> pay-modes cheque">
                        <div class="form-group">
                            <?php
                                $attributes=array("id"=>"cheque_no","Placeholder"=>"Cheque No",'readonly'=>'true',
                                                  "autocomplete"=>"off");
                                echo create_form_input("text","cheque_no","Cheque No",true,$booking['payment']['cheque_no']??'',$attributes); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4 <?= $paymode=='cheque' ?'':'d-none' ?> pay-modes cheque">
                        <div class="form-group">
                            <?php
                                $attributes=array("id"=>"cheque_date",'readonly'=>'true',
                                                  "autocomplete"=>"off");
                                echo create_form_input("date","cheque_date","Cheque Date",true,$booking['payment']['cheque_date']??'',$attributes); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                                $attributes=array("id"=>"paid_amount","Placeholder"=>"Paid Amount",'readonly'=>'true',
                                                  "autocomplete"=>"off",'step'=>'0.01');
                                echo create_form_input("number","paid_amount","Paid Amount",true,$booking['payment']['amount']??'',$attributes); 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="approve-btn" >Approve Payment</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
                <script>
                    $(document).ready(function(e) {
                        createDatatable();
                        $('body').on('click','.approve',function(){
                            var id=$(this).val();
                            if(confirm("Confirm Approve this Booking?")){
                               $.post('<?= base_url('bookings/approvebooking') ?>',{id:id},function(){
                                   window.location.reload();
                               });
                            }
                        });
                        $('body').on('click','.view',function(){
                            $('.modal-body,#approve-btn').addClass('d-none');
                            $('.modal-body.loader').removeClass('d-none');
                            let id=$(this).val();
                            $.post('<?= base_url('bookings/getpayment'); ?>',{id:id},function(data){
                                console.log(data);
                                data=JSON.parse(data);
                                $('#price').val(data['price']);
                                $('#other_price').val(data['other_price']);
                                $('#total_amount').val(data['total_amount']);
                                $('#payment_type').val(data['payment_type']);
                                $('#payment_date').val(data['date']);
                                $('#payment_mode').val(data['payment_mode']).trigger('change');
                                $('#paid_amount').val(data['amount']);
                                $('#receiver_name').val(data['receiver_name']);
                                $('#cheque_no').val(data['cheque_no']);
                                $('#cheque_date').val(data['cheque_date']);
                                $('#utr_no').val(data['utr_no']);
                                $('.modal-body').toggleClass('d-none');
                                $('#approve-btn').val(id);
                                if(data['status']==0){
                                    //$('#approve-btn').removeClass('d-none');   
                                }
                            });
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
                    });

                    function createDatatable(){
                        $('#status').html('');
                        table=$('#bootstrap-data-table-export').DataTable();
                        table.columns('.select-filter').every(function(){
                            var that = this;
                            var pos=$('#status');
                            // Create the select list and search operation
                            var select = $('<select class="form-control" />').appendTo(pos).on('change',function(){
                                            that.search("^" + $(this).val() + "$", true, false, true).draw();
                                        });
                                select.append('<option value=".+">All</option>');
                            // Get the search data for the first column and add to the select list
                            this.cache( 'search' ).sort().unique().each(function(d){
                                    select.append($('<option value="'+d+'">'+d+'</option>') );
                            });
                        });
                        $('#member_id').on('keyup',function(){
                            table.columns(1).search( this.value ).draw();
                        });
                    }
                    
                    function validate(){
                    }
                </script>
