<div class="white-bg ">
<br>
   <ul class="list-group elements-list" style="padding-left:40px;" >
        <li class="list-group-item">
            <a class="nav-link active"  data-toggle="tab" href="#profile" > <span class="fa fa-user"></span>  Profile
            </a> 
        </li>
        <li class="list-group-item">
            <a class="nav-link "  data-toggle="tab" href="#tab-contact" ><span class="fa fa-phone"></span>  Contact
            </a> 
        </li>
    <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)||($_SESSION['id']==$user['id'])) { ?>       
    <li class="list-group-item">
        <a class="nav-link "  data-toggle="tab" href="#password" > <span class="fa fa-key"></span>  Password
        </a> 
    </li>
    <?php } ?>  
</ul>
</div>
