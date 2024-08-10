   <div class="tab-pane fade" id="password">
             
             <div class="form-group row justify-content-center" >
             
                <div class="col-lg-6 pt-3">

              <?php if (isset($user['check'])?$user['check']:""==0) { ?>
                <div class="card card-primary" >
                 <div class="panel-heading text-center"><h4 class="text-danger">Password Not Set !</h4></div>
                  <div class="card-body">
               <?php if((isset($user['id'])?$user['id']:""==$_SESSION['id']) || ($_SESSION['role_id']==5)|| ($_SESSION['role_id']==1)){ ?>
                      <button class="btn btn-block btn-success btn-md" type="button" data-toggle="modal" data-target="#password-modal"><i class="fa fa-edit"></i> Set Password </button>
                    <?php } ?>
                  </div>
                </div>
                <?php } else { ?>
                <div class="card card-default" >
                 <div class="panel-heading text-center"><h4 class="text-green"><i class="fa fa-check"></i> Change your Password </h4></div>
                  <div class="card-body">
              <?php if((isset($user['id'])?$user['id']:""==$_SESSION['id']) || ($_SESSION['role_id']==5) ||($_SESSION['role_id']==1)){ ?>
                      <button class="btn btn-block btn-primary btn-md" type="button" data-toggle="modal" data-target="#password-modal"><i class="fa fa-edit"></i> Change Password</button>
                    <?php } ?>
                  </div>
                </div>
                <?php } echo view('users/staff/password/password_modal'); ?>
                </div>
                </div>
            </div>