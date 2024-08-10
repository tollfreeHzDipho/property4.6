        if($('#tblContact').length && tabClicked === "tab-contact") {
                if(typeof(dTable['tblContact'])!=='undefined'){
                    $("#tab-contact").addClass("active");
                    //dTable['tblContact'].ajax.reload(null,true);
                }else{
         dTable['tblContact']=$('#tblContact').DataTable({
            "searching": false,
            "paging": false,
            "responsive": true,
            "dom": '<"html5buttons"B>lTfgitp',
            "buttons": getBtnConfig('Contact Details'),
            "ajax":{
             "url": "<?php echo base_url('contact.jsonList'); ?>",
             "dataType": "json",
             "type": "POST",
             "data": function (d) {
                            d.user_id = "<?php echo isset($user['id'])?$user['id']:'' ?>";
                     }
                     },
        "columns": [
                  { "data": "mobile_number" },
                  { "data": "contact_type" }
      <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)) { ?>
                  ,
                  { "data": "id", render:function ( data, type, full, meta ) {
                    var ret_txt ="";
                    ret_txt += "<a href='#' data-toggle='modal' class='btn btn-sm btn-default delete_me' data-toggle='tooltip' title='Delete record'><i class='fa fa-trash'></i></a>";
                    return ret_txt;
                  }}
                <?php } ?>
               ]     
        });
        }
}
