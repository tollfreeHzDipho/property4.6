if ($("#tblStaff_inactive").length && tabClicked === "inactive") {
    if(typeof(dTable['tblStaff_inactive'])!=='undefined'){
        $("#active").removeClass("active");
        $("#inactive").addClass("active");
        dTable['tblStaff_inactive'].ajax.reload(null,true);
        counter=1;
   }else{
    counter=1;
    dTable['tblStaff_inactive'] = $('#tblStaff_inactive').DataTable( {
    "pageLength": 10,
    "searching": true,
    "paging": true,
    "processing": false,
    "responsive": true,
    "dom":"<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +"<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)) { ?> getBtnConfig('Staff'), <?php } else { echo "[],"; } ?>
      "ajax": {
        url:"<?php echo site_url("staff.json");?>",
        dataType: 'JSON',
        type: 'POST',
        data: function(d){
          d.status_id=4;
        }
      },
      columnDefs: [{
                  "targets": [5],
                  "orderable": false,
                  "searchable": false
              }],
      columns:[
      {data: 'id', render: function (data, type, full, meta) {
            return counter++;
        }
      },
      { data: 'salutation', render:function ( data, type, full, meta ) { 
         return "<a href='<?php echo site_url("staff/view"); ?>/" + full.id + "'>" + full.first_name +" " + full.last_name + "  " + full.other_names + "</a>";}},
      { data: 'initials' },
      { data: 'mobile_number'},
      { data: 'email'},
      { data: 'branch_name' },
      { data: 'status_name'}
      <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)) { ?>      
      ,
      { data: 'id', render:function ( data, type, full, meta ) {
        var ret_txt ="<a class='badge badge-info edit_me' data-toggle='modal' style='margin-right:10px;' href='#add_staff-modal'><i class='fa fa-edit'></i></a>";
        ret_txt += "<a href='#' data-toggle='modal' style='margin-right:10px;' class='badge badge-warning activate'><i class='fa fa-refresh'></i></a>";
        ret_txt += "<a href='#' data-toggle='modal'  class='badge badge-danger delete_me'><i class='fa fa-trash'></i></a>";

        return ret_txt;
      } }
    <?php } ?>
      ]
      
    });
}
}