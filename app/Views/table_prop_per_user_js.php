<script>
  var dTable = {};

  $(document).ready(function() {
    //  $('form#formGroup').validator().on('submit', saveData);
    /* PICK DATA FOR DATA TABLE  */
    var counter = 1;
    dTable['tblPropPerUser'] = $('#tblPropPerUser').DataTable({
      dom: '<"html5buttons"B>lTfgitp',
      "deferRender": true,
      "order": [
        [0, 'DESC']
      ],
      "ajax": {
        "url": "<?php echo site_url("property_per_user"); ?>",
        "dataType": "JSON",
        "type": "POST",
        "data": function(d) {
          d.status_id = 1;
        }
      },
      "columnDefs": [{
        "targets": [3],
        "orderable": false,
        "searchable": false
      }],
      columns: [
        {
          data: 'initials'
        },
        {
          data: 'salutation',
          render: function(data, type, full, meta) {
            return  full.first_name + " " + full.last_name + "  " + full.other_names+" ("+full.initials+")" ;
          }
        },
        {
          data: 'count'
        },
        {
          data: 'valuer_id',
          render: function(data, type, full, meta) {
            var ret_txt = "<a class='badge badge-default' style='margin-right:10px;' href='<?php echo base_url("property_pa_valuer"); ?>/"+full.valuer_id+"'>View <i class='fa fa-ellipsis-h'></i></a>";
            return ret_txt;
          }
        }

      ],
      buttons: <?php
                echo "[],";
                ?>

    });
    dTable['tblPropPerUser'].on('order.dt search.dt', function() {
      dTable['tblPropPerUser'].column(0, {
        search: 'applied',
        order: 'applied'
      }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1;
      });
    }).draw( );


  });
</script>