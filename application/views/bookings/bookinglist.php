	
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
                                                            <th>Member ID</th>
                                                            <th>Member Name</th>
                                                            <th>Booking Name</th>
                                                            <th>Email</th>
                                                            <th>Mobile</th>
                                                            <th>Type</th>
                                                            <th>City</th>
                                                            <th>Landmark</th>
                                                            <th>Booking Amount</th>
                                                            <th>Token Amount</th>
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
                                                            if(is_array($bookings)){$i=0;
                                                                foreach($bookings as $booking){
                                                                    $i++;
                                                                    $status="<span class='text-danger'>Not Approved</span>";
                                                                    if($booking['status']==1){
                                                                        $status="<span class='text-success'>Approved</span>";
                                                                    }elseif($booking['status']==2 && $booking['approved_on']===NULL){
                                                                        $status="<span class='text-danger'>Request Cancelled</span>";
                                                                    }elseif($booking['status']==2){
                                                                        $status="<span class='text-danger'>Request Rejected By Admin</span>";
                                                                    }
                                                        ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td><?php echo $booking['member_id']; ?></td>
                                                            <td><?php echo $booking['member_name']; ?></td>
                                                            <td><?php echo $booking['name']; ?></td>
                                                            <td><?php echo $booking['email']; ?></td>
                                                            <td><?php echo $booking['mobile']; ?></td>
                                                            <td><?php echo $booking['type']; ?></td>
                                                            <td><?php echo $booking['city']; ?></td>
                                                            <td><?php echo $booking['landmark']; ?></td>
                                                            <td><?php echo $booking['total_amount']; ?></td>
                                                            <td><?php echo $booking['token_amount']; ?></td>
                                                            <td><?php echo $booking['b_type']; ?></td>
                                                            <td><?php echo $booking['payment_type']; ?></td>
                                                            <td><?php echo $booking['payment_mode']; ?></td>
                                                            <td><?php echo $booking['a_status']; ?></td>
                                                            <td><?php echo date('d-m-Y',strtotime($booking['added_on'])); ?></td>
                                                            <td><?php echo $booking['status']; ?></td>
                                                            <td></td>
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
                <h5 class="modal-title pull-left" id="mediumModalLabel"></h5>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" alt="" id="img-popup" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
                <script>
                    $(document).ready(function(e) {
                        createDatatable();
                        $('body').on('click','.view',function(){
                            $('#img-popup').attr('src','');
                            var src=$(this).val();
                            $('#img-popup').attr('src',src);
                            $('#mediumModalLabel').text($(this).text());
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
