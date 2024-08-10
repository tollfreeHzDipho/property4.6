
if ($("#tblProperty").length && tabClicked === "tab-active") {
  if(typeof(dTable['tblProperty'])!=='undefined'){
        $("#tab-inactive").removeClass("active");
        $("#tab-active").addClass("active");
        dTable['tblProperty'].ajax.reload(null,true);
        counter=1;
   }else{
    dTable['tblProperty'] = $('#tblProperty').DataTable( {
    "pageLength": 10,
    "searching": true,
    "paging": true,
    "processing": false,
    "order": [[ 0, "desc" ]],
    "responsive": true,
    "dom":"<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +"<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-5'i><'col-sm-7'p>>",
      buttons: <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)||($_SESSION['role_id']==3)) { ?> getBtnConfig('Property Data'), <?php } else { echo "[],"; } ?>
      "ajax": {
        url:"<?php echo site_url("property.json");?>",
        dataType: 'JSON',
        type: 'POST',
        data: function(d){
          d.status_id=1;
        }
      },
        scrollCollapse: true,
      columnDefs: [{
                  "targets": [16],
                  "width": '20%',
                  "orderable": false,
                  "searchable": false
              }],

      columns:[
      {data: 'serial_no', render: function (data, type, full, meta) {
            return "<a href='<?php echo site_url("property/details"); ?>/" + full.id + "'>" + data + "</a>";
        }
      },
      { data: 'tenure' },
      { data: 'property_address', render:function ( data, type, full, meta ) { 
         return "<a href='<?php echo site_url("property/view"); ?>/" + full.id + "'>" + data + "  ( "+ full.district_name +" ) </a>";}},
      { data: 'district_name' },
      { data: 'town_id'},
      { data: 'village_id'},
      {data: 'bank_name', render: function (data, type, full, meta) {
            if(parseInt(full.bank_id)===9999){
            return full.bank_option;
            } else {
            return data;
            }
        }
      },
      { data: 'north'},
      { data: 'east' },
      { data: 'acreage' },
      {data: 'rate_per_acre', render: function (data, type, full, meta) {
            return data ? curr_format(data*1) : 'N/A';
        }
      },
      {data: 'property_value', render: function (data, type, full, meta) {
            return data ? curr_format(data*1) : 'N/A';
        }
      },
      { data: 'user_status' },
      {data: 'date_of_val', render: function (data, type, full, meta) {
            return data ? moment(data, 'YYYY-MM-DD').format('D-MMM-YYYY') : 'N/A';
        }
      },
      { data: 'valuer_id', render:function ( data, type, full, meta ) { 
         return "<a href='<?php echo site_url("staff/view"); ?>/" + data + "'>( "+full.valuer_initials+" )</a>";}},
      {data: 'status_name', render: function (data, type, full, meta) {
            return "<span class='badge badge-success'>"+data+"</span>";
        }
      }
      <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)||($_SESSION['role_id']==3)) { ?>
      ,
       {data: 'created_first_name',
          render: function(data, type, full, meta) {
            return  data + " " + full.created_last_name + "  " + full.created_other_names ;
          }
      },
      {data: 'date_created', render: function (data, type, full, meta) {
            return data ? moment(data, 'YYYY-MM-DD').format('D-MMM-YYYY') : 'N/A';
        }
      },
      { data: 'id', render:function ( data, type, full, meta ) {
        var ret_txt ="<a class='badge badge-info edit_me' data-toggle='modal' style='margin-right:10px;' href='#add_property-modal'><i class='fa fa-edit'></i></a>";
        ret_txt += "<a href='#' data-toggle='modal' style='margin-right:10px;' class='badge badge-warning deactivate'><i class='fa fa-refresh'></i></a>";
        <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)) { ?>
        ret_txt += "<a href='#' data-toggle='modal'  class='badge badge-danger delete_me'><i class='fa fa-trash'></i></a>";
        <?php } ?>
        return ret_txt;
      } }
    <?php } ?>

      ]
      
    });
}
}
