
                            <div class="col-md-12">
                                <div class="card light-bg" style="height:95%;">
                                    <div class="card-header">
                                        <h3 class="card-title"><?= $title ?></h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <?php  
                                            if($this->session->role=='admin'){
                                        ?>
                                        
                                        <div class="row">
                                            <div class="col-lg-3 col-6">
                                                <a href="<?= base_url('members/memberlist/'); ?>">            
                                                    <div class="card bg-info">
                                                        <div class="card-body">
                                                            <div class="inner">
                                                                <h3><?= $total_users??0; ?></h3>
                                                                <p>Total Users</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="fas fa-users"></i>
                                                            </div>
                                                            <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <a href="<?= base_url('members/activelist/'); ?>">            
                                                    <div class="card bg-success">
                                                        <div class="card-body">
                                                            <div class="inner">
                                                                <h3><?= $active_users??0; ?></h3>
                                                                <p>Active Users</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="fa fa-users"></i>
                                                            </div>
                                                            <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <a href="<?= base_url('members/inactivelist/'); ?>">            
                                                    <div class="card bg-primary">
                                                        <div class="card-body">
                                                            <div class="inner">
                                                                <h3><?= $inactive_users??0 ?></h3>
                                                                <p>In-Active Users</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="fas fa-users"></i>
                                                            </div>
                                                            <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-6">
                                                <a href="#">            
                                                    <div class="card bg-warning">
                                                        <div class="card-body">
                                                            <div class="inner">
                                                                <h3><?= $landbookings??0; ?></h3>
                                                                <p>Land Bookings</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="fas fa-list"></i>
                                                            </div>
                                                            <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <a href="#">            
                                                    <div class="card bg-info">
                                                        <div class="card-body">
                                                            <div class="inner">
                                                                <h3><?= $flatbookings??0; ?></h3>
                                                                <p>Flat Bookings</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="fa fa-list"></i>
                                                            </div>
                                                            <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <a href="#">            
                                                    <div class="card bg-danger">
                                                        <div class="card-body">
                                                            <div class="inner">
                                                                <h3><?= $pendingbookings??0 ?></h3>
                                                                <p>Pending Bookings</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="fas fa-list"></i>
                                                            </div>
                                                            <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <a href="#">            
                                                    <div class="card bg-success">
                                                        <div class="card-body">
                                                            <div class="inner">
                                                                <h3><?= $approvedbookings??0 ?></h3>
                                                                <p>Approved Bookings</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="fas fa-list"></i>
                                                            </div>
                                                            <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div><hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <div class="lead">New Users</div>
                                                    <table class="table table-bordered table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Sl.No.</th>
                                                                <th>Registration No</th>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Mobile</th>
                                                                <th>Sponsor</th>
                                                                <th>Status</th>
                                                                <th>Joining Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if(!empty($newusers)){$i=0;
                                                                foreach($newusers as $user){
                                                                    $status='<span class="badge badge-success">Active</span>';
                                                                    if($user['status']==0){
                                                                        $status='<span class="badge badge-danger">In-Active</span>';
                                                                    }
                                                            ?>
                                                            <tr>
                                                                <td><?= ++$i; ?></td>
                                                                <td><?= $user['username']; ?></td>
                                                                <td><?= $user['name']; ?></td>
                                                                <td><?= $user['email']; ?></td>
                                                                <td><?= $user['mobile']; ?></td>
                                                                <td><?= $user['sponsor']; ?></td>
                                                                <td><?= $status; ?></td>
                                                                <td><?= date('d-m-Y',strtotime($user['date'])); ?></td>
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
                                        <?php
                                            }
                                            else{
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="text-danger text-center"><?= $message; ?></h3>
                                            </div>
                                        </div>
                                        <div class="row profile">
                                            <div class="col-md-6 mb-3">
                                                <div class="card light-bg">
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <table class="table" id="personal-details">
                                                            <tr>
                                                                <td colspan="2">
                                                                    <img src="<?php if($member['photo']!=''){echo file_url($member['photo']);}else{echo file_url('assets/images/avatar.png');} ?>" 
                                                                            style="height:135px; width:120px;" alt="User Image" id="view_photo">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Registration No</th>
                                                                <td><?= $user['username']; ?></td>

                                                            </tr>
                                                            <tr>
                                                                <th>Name</th>
                                                                <td><?= $member['name']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Joining Date</th>
                                                                <td><?= date('d-m-Y h:i A',strtotime($member['date'].' '.$member['time'])); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Activation Date</th>
                                                                <td><?= !empty($member['activation_date']) && $member['activation_date']!='0000-00-00'?date('d-m-Y h:i A',strtotime($member['activation_date'])):'--'; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Status</th>
                                                                <td>
                                                                    <?php
                                                                        if($member['status']==1){
                                                                            echo '<span class="text-success">Active<span>';
                                                                        }
                                                                        else{
                                                                            echo '<span class="text-danger">In-Active<span>';
                                                                        }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Share Partner</th>
                                                                <td>
                                                                    <?= $this->wallet->getrank($user['id'])??'--'; ?>
                                                                </td>
                                                            </tr>
                                                            <?php /*?><tr>
                                                                <th>Father's Name</th>
                                                                <td><?= $member['father']; ?></td>
                                                            </tr><?php */?>
                                                        </table><hr>
                                                        <div class="row d-none">
                                                            <div class="col-md-12">
                                                                <h3 class="">Referral Link</h3>
                                                                <div class="lead text-success my-2" id="copyLink">
                                                                    <?= base_url('signup/?sponsor='.$user['username']); ?>
                                                                </div>
                                                                <a href="<?= base_url('signup/?sponsor='.$user['username']); ?>" class="btn btn-sm btn-info" target="_blank">Open Link</a>
                                                                <button onclick="copyLink()" class="btn btn-sm btn-info">Copy Link</button>
                                                            </div>
                                                        </div><hr>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <?php
                                                ?>
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <a href="#">            
                                                            <div class="card bg-info">
                                                                <div class="card-body">
                                                                    <div class="inner">
                                                                        <h3><?= $this->amount->toDecimal($left,false); ?></h3>
                                                                        <p>Left Team</p>
                                                                    </div>
                                                                    <div class="icon">
                                                                        <i class="fas fa-users"></i>
                                                                    </div>
                                                                    <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <a href="#">            
                                                            <div class="card bg-maroon">
                                                                <div class="card-body">
                                                                    <div class="inner">
                                                                        <h3><?= $this->amount->toDecimal($right,false); ?></h3>
                                                                        <p>Right Team</p>
                                                                    </div>
                                                                    <div class="icon">
                                                                        <i class="fas fa-users"></i>
                                                                    </div>
                                                                    <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <a href="#">            
                                                            <div class="card bg-primary">
                                                                <div class="card-body">
                                                                    <div class="inner">
                                                                        <h3><?= $this->amount->toDecimal($leftbv,true,3); ?></h3>
                                                                        <p>Left BV</p>
                                                                    </div>
                                                                    <div class="icon">
                                                                        <i class="fas fa-money-bill"></i>
                                                                    </div>
                                                                    <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <a href="#">            
                                                            <div class="card bg-orange text-white">
                                                                <div class="card-body">
                                                                    <div class="inner text-white">
                                                                        <h3><?= $this->amount->toDecimal($rightbv,true,3); ?></h3>
                                                                        <p>Right BV</p>
                                                                    </div>
                                                                    <div class="icon text-white">
                                                                        <i class="fas fa-money-bill"></i>
                                                                    </div>
                                                                    <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <a href="#">            
                                                            <div class="card bg-purple">
                                                                <div class="card-body">
                                                                    <div class="inner">
                                                                        <h3><?= $this->amount->toDecimal($bookings,false); ?></h3>
                                                                        <p>My Bookings</p>
                                                                    </div>
                                                                    <div class="icon">
                                                                        <i class="fas fa-list"></i>
                                                                    </div>
                                                                    <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <a href="#">            
                                                            <div class="card bg-warning text-white">
                                                                <div class="card-body">
                                                                    <div class="inner text-white">
                                                                        <h3><span>$</span> <?= $this->amount->toDecimal($myincome,true,3); ?></h3>
                                                                        <p>My Income</p>
                                                                    </div>
                                                                    <div class="icon text-white">
                                                                        <i class="fas fa-money-bill"></i>
                                                                    </div>
                                                                    <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <a href="#">            
                                                            <div class="card bg-success">
                                                                <div class="card-body">
                                                                    <div class="inner">
                                                                        <h3><span>$</span> <?= $this->amount->toDecimal($mypayout,true,3); ?></h3>
                                                                        <p>My Payout</p>
                                                                    </div>
                                                                    <div class="icon">
                                                                        <i class="fas fa-money-bill"></i>
                                                                    </div>
                                                                    <!-- <a href="#" class="card-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>

                <script>
                    $(document).ready(function(){
                        <?php if($this->session->role!='admin'){ ?>
                        $('#table').dataTable();
                        <?php } ?>
                    });
                    function copyLink() {
                      // Select the link text
                      const linkElement = document.getElementById('copyLink');
                      const linkText = linkElement.textContent || linkElement.innerText;

                      // Use navigator.clipboard.writeText for modern browsers
                      navigator.clipboard.writeText(linkText)
                        .then(() => {
                          alert('Referral Link copied to clipboard!');
                        })
                        .catch((err) => {
                          console.error('Unable to copy link', err);
                        });
                    }
                </script>
