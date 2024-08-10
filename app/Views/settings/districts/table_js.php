if ($("#tblDistrict").length && tabClicked === "tab-district") {
    if(typeof(dTable['tblDistrict'])!=='undefined'){
        $(".settings").removeClass("active");
        $("#tab-district").addClass("active");
        dTable['tblDistrict'].ajax.reload(null,true);
        counter=1;
   }else{
    counter=1;
    dTable['tblDistrict'] = $('#tblDistrict').DataTable( {
    "pageLength": 10,
    "searching": true,
    "paging": true,
    "processing": false,
    "responsive": true,
    "dom":"<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +"<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)) { ?> getBtnConfig('Districts'), <?php } else { echo "[],"; } ?>
      "ajax": {
        url:"<?php echo site_url("district.json");?>",
        dataType: 'JSON',
        type: 'POST',
        data: function(d){
         // d.status_id=1;
        }
      },
      columns:[
      {data: 'id', render: function (data, type, full, meta) {
            return counter++;
        }
      },
      { data: 'district_name' },
      {data: 'status_name', render: function (data, type, full, meta) {
        if(parseInt(full.status_id)==1){
            return "<span class='badge badge-success'>"+data+"</span>";
        } else {
            return "<span class='badge badge-danger'>"+data+"</span>";
            
        }
        }
      }
      <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)) { ?>
      ,
      { data: 'id', render:function ( data, type, full, meta ) {
        var ret_txt ="<a class='badge badge-info edit_me' data-toggle='modal' style='margin-right:10px;' href='#add_district'><i class='fa fa-edit'></i></a>";
        if(parseInt(full.status_id)==4){
        ret_txt += "<a href='#' data-toggle='modal' style='margin-right:10px;' title='Activate this record' class='badge badge-success activate'><i class='fa fa-refresh'></i></a>";
        }
        if(parseInt(full.status_id)==1){
        ret_txt += "<a href='#' data-toggle='modal' style='margin-right:10px;' title='De-activate this record'  class='badge badge-warning deactivate'><i class='fa fa-refresh'></i></a>";
        }
        ret_txt += "<a href='#' data-toggle='modal'  class='badge badge-danger delete_me'><i class='fa fa-trash'></i></a>";

        return ret_txt;
      } }
    <?php } ?>
      ]
      
    });
}
}