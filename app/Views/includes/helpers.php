<script>
    //Only when the document has fully loaded
    var idleTime = 0;
    var periods = ['days', 'weeks', 'months'];
    var start_date, end_date;
    $(document).ready(function() {
        //for all forms with the formValidate class, validate the form and send data to the database
        //$('form.formValidate').validator().on('submit', saveData);
        //Any edit to be done uses this code for modal popu-up
        $('table tbody').on('click', 'tr .edit_me', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var tbl = row.parent().parent();
            tbl_id = $(tbl).attr("id");
            var dt = dTable[tbl_id];
            var data = dt.row(row).data();
            if (typeof(data) === 'undefined') {
                data = dt.row($(row).prev()).data();
                if (typeof(data) === 'undefined') {
                    data = dt.row($(row).prev().prev()).data();
                }
            }
            var formId = tbl_id.replace("tbl", "form");
            //these are the specific table ids from which we identify which forms can be populated by the set selects function
            var applicable_tables = ["tblAddress", "tblFixed_asset", "tblJournal_transaction", "tblExpense", "tblBill", "tblIncome", "tblInvoice"];
            if (check_in_array(tbl_id, applicable_tables) && typeof set_selects !== 'undefined' && typeof set_selects === "function") {
                set_selects(data, formId);
            } else {
                edit_data(data, formId);
            }

        });
        //This code section to change the status of a given record to active
        $('table tbody').on('click', 'tr .activate', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var tbl = row.parent().parent();
            var tbl_id = $(tbl).attr("id");
            var dt = dTable[tbl_id];
            var data = dt.row(row).data();
            if (typeof(data) === 'undefined') {
                data = dt.row($(row).prev()).data();
                if (typeof(data) === 'undefined') {
                    data = dt.row($(row).prev().prev()).data();
                }
            }
            var contro = tbl_id.replace("_inactive", "");
            var controller = contro.replace("tbl", "");
            var url = "<?php echo site_url(); ?>" + controller.toLowerCase() + "/change_status";

            activate({
                id: data.id,
                status_id: 1
            }, url, tbl_id);
        });
        //This code section to change the status of a given record to inactive
        $('table tbody').on('click', 'tr .deactivate', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var tbl = row.parent().parent();
            var tbl_id = $(tbl).attr("id");
            var dt = dTable[tbl_id];
            var data = dt.row(row).data();
            if (typeof(data) === 'undefined') {
                data = dt.row($(row).prev()).data();
                if (typeof(data) === 'undefined') {
                    data = dt.row($(row).prev().prev()).data();
                }
            }
            var controller = tbl_id.replace("tbl", "");
            var url = "<?php echo site_url(); ?>" + controller.toLowerCase() + "/change_status";

            deactivate({
                id: data.id,
                status_id: 4
            }, url, tbl_id);
        });
        //Any delete to be done uses this code for modal pop-up
        $('table tbody').on('click', 'tr .delete_me', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var tbl = row.parent().parent();
            var tbl_id = $(tbl).attr("id");
            var dt = dTable[tbl_id];
            var data = dt.row(row).data();
            if (typeof(data) === 'undefined') {
                data = dt.row($(row).prev()).data();
                if (typeof(data) === 'undefined') {
                    data = dt.row($(row).prev().prev()).data();
                }
            }
            var controller = tbl_id.replace("tbl", "");
            var url = "<?php echo site_url(); ?>/" + controller.toLowerCase() + "/delete";
            delete_item("Are you sure, you want to delete this record?", data.id, url, tbl_id);
        });

        // clear the fields in forms whose modal dialogs have been closed
        $("div.modal").on("hide.bs.modal", function() {
            var steps_form = $('#add_client_loan-modal');
            if (steps_form.length > 0) {
                steps_form.steps("reset");
            }
            var forms = $('form', this);
            clear_forms(forms);
        });

        if ($('.date').length > 0) {
            $('.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm-dd"
            }).on('hide', function(e) {
                e.stopPropagation();
            }).on('changeDate', function(e) {
                $(e.target).trigger('change');
            });
        }

    }); //End of the document is ready operations
    //function to clear the forms
    function clear_forms(forms) {
        if (forms.length) {
            //lets go thru each and every form element which is not a form submit element and clear the value
            var form_elements = $('input:not(:submit)input:not(:hidden),select,textarea', $(forms[0]));
            $.each(form_elements, function(key, form_element) {
                $(form_element).val('').trigger('change');
                if (form_element.type === 'radio' || form_element.type === 'checkbox') {
                    $(form_element).prop("checked", false).trigger('change');
                    if (typeof client_loanModel !== 'undefined' && typeof client_loanModel.checkbox !== 'undefined') {
                        client_loanModel.checkbox(false);
                    }
                }
            });
            forms[0].reset();
            $('input[name="id"]', $(forms[0])).val('');
            //$('input[type="hidden"]', this).val('');
            var datepicker = $('.date', $(forms[0]));
            if (datepicker.length) {
                datepicker.datepicker('clearDates');
            }
        }
    }
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "preventDuplicates": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "7000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    //return Initials of all the words in a string
    function abbreviate(str) { //pull out initials
        var matches = str.match(/\b(\w)/g);
        var acronym = matches.join('').toUpperCase();
        return (acronym);
    }
    //return a number with zeros prepended to it
    function zeroFill(number, width) {
        //Prrepend with zeros
        width -= number.toString().length;
        if (width > 0) {
            return new Array(width + (/\./.test(number) ? 2 : 1)).join('0') + number;
        }
        return number + ""; // always return a string
    }
    //This function helps to add and update info
    function saveData(e) {
        if (e.isDefaultPrevented()) {
            // handle the invalid form...
            console.log('Please fill all the fields correctly');
        } else {
            // everything looks good!
            e.preventDefault();
            saveData2(e.target);
        }
    } //End of the saveData function
    function saveData2(form) {
        var $form = $(form); //fv = $form.data('formValidation'),
        enableDisableButton(form, true);
        var formData = new FormData($form[0]);
        var id = $form.attr('id');
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(feedback) {
                if (feedback.success) {
                    if (isNaN(parseInt($form.attr('id')))) {
                        $form[0].reset();
                        $modal = $form.parents('div.modal');
                        if ($modal.length) {
                            $($modal[0]).modal('hide');
                        }
                    }
                    setTimeout(function() {
                        var formId = $form.attr('id');
                        var tblId = formId.replace("form", "tbl");
                        if (typeof dTable !== 'undefined' && typeof dTable[tblId] !== 'undefined') {
                            dTable[tblId].ajax.reload((typeof consumeDtableData !== 'undefined') ? consumeDtableData : null, false);
                        }
                        if (typeof reload_data === "function") {
                            reload_data(formId, feedback);
                        }
                    }, 1000);
                    toastr.success(feedback.message, "Success");
                } else {
                    toastr.warning(feedback.message, "Failure!");
                }
                enableDisableButton(form, false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                network_error(jqXHR, textStatus, errorThrown, form);
            }
        });
    } //End of the saveData2 function

    //This function helps to pass data for edit to the modal form
    function edit_data(data_array, form) {
        $.each(data_array, function(key, val) {
            $.map($('#' + form + ' [name="' + key + '"]'), function(named_item) {
                if (named_item.type === 'radio' || named_item.type === 'checkbox') {
                    $(named_item).prop("checked", (named_item.value === val ? true : false)).trigger('change');
                } else {
                    var reg_ex = /date/;
                    $(named_item).val(val).trigger('change');
                    if (key == 'account_code') {
                        const account_code_array = val.toString().split("-");
                        account_code_array.length && $("input[name='parent_account_id']").val(data_array['parent_account_id']).trigger('change');
                        account_code_array.length && $("input[name='new_account_code']").val(account_code_array[account_code_array.length - 1]).trigger('change');
                    }
                    if (reg_ex.test(key)) {
                        if (val != null) {
                            var date_val = moment(val, 'YYYY-MM-DD').format('DD-MM-YYYY');
                            //console.log($(named_item));
                            $(named_item).val(date_val).trigger('change');
                            setDpDate("#" + key, date_val);
                        }
                    }
                    var date_picker = $("#" + key).parent(".date");
                    if (date_picker.length) {
                        date_picker.datepicker('setDate', val);
                    }
                }
            });
        });
    }
    //check if an element is in array
    function check_in_array($find, $array, search_key) {
        var arr_len = $array.length;
        for (var i = 0; i < arr_len; i++) {
            var $element = $array[i];
            if (($find == ((typeof search_key === 'undefined') ? $element : $element[search_key]))) {
                return true;
            }
        }
        return false;
    }
    //set the Date picker date
    function setDpDate(field, val) {
        var date_picker = $(field).parent(".date");
        if (date_picker.length) {
            date_picker.datepicker('setDate', val);
        } else {
            date_picker = $((field + ".datepicker"));
            if (date_picker.length) {
                date_picker.datepicker('setDate', val);
            }
        }
    }

    //function sets the object for the buttons to be added to the datatables
    function getBtnConfig(title) {
        var btn_configs = [

            {
                extend: 'copyHtml5',
                text: '<i class="fa fa-copy"></i>',
                titleAttr: 'Copy',
                //title: $('.download_label').html(),
                title: title,
                exportOptions: {
                    columns: ':visible'
                }
            },

            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o text-green"></i>',
                titleAttr: 'Excel',

                title: title,
                exportOptions: {
                    columns: ':visible'
                }
            },

            {
                extend: 'csvHtml5',
                text: '<i class="fa fa-file-o text-green"></i>',
                titleAttr: 'CSV',
                title: title,
                exportOptions: {
                    columns: ':visible'
                }
            },

            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf-o text-danger"></i>',
                titleAttr: 'PDF',
                title: title,
                exportOptions: {
                    columns: ':visible'

                }
            }, /**/

            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                title: title,
                customize: function(win) {
                    $(win.document.body)
                        .css('font-size', '10pt');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                },
                exportOptions: {
                    columns: ':visible'
                }
            }
            /*,
                         
                         {
                         extend: 'colvis',
                         text: '<i class="fa fa-columns"></i>',
                         titleAttr: 'Columns',
                         title: title,
                         postfixButtons: ['colvisRestore']
                         }*/
        ];
        return btn_configs;
    }
    //function for deleting message
    function confirm_delete(msg) {
        var really = confirm(msg + "?");
        return really;
    }

    //Activate function
    function activate(data, url, tblId) {
        msg = "You are about to Activate the selected record. Are you sure you would like to proceed?";
        swal({
                title: "Are you sure?",
                text: msg,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#FF4500",
                confirmButtonText: "Yes!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false
            },
            function() {
                $.post(
                    url,
                    data,
                    function(response) {
                        if (response.success) {
                            setTimeout(function() {
                                toastr.success(response.message, "Success!");
                                //any other tasks(function) to be run here
                                if (typeof dTable !== 'undefined' && typeof dTable[tblId] !== 'undefined') {
                                    dTable[tblId].ajax.reload((typeof consumeDtableData !== 'undefined') ? consumeDtableData : null, false);
                                }
                                if (typeof reload_data === "function") {
                                    reload_data(tblId.replace("tbl", "form"), response);
                                }
                            }, 1000);
                        } else {
                            toastr.error("", "Operation failed. Reason(s):<ol>" + response.message + "</ol>", "Request failed!");
                        }
                    },
                    'json').fail(function(jqXHR, textStatus, errorThrown) {
                    network_error(jqXHR, textStatus, errorThrown, $("#myform"));
                });
                swal.close();
            });
    }

    function deactivate(data, url, tblId) {
        msg = "You are about to De-activate the selected record. Are you sure you would like to proceed?";
        swal({
                title: "Are you sure?",
                text: msg,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#FF4500",
                confirmButtonText: "Yes!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false
            },
            function() {
                $.post(
                    url,
                    data,
                    function(response) {
                        if (response.success) {
                            setTimeout(function() {
                                toastr.success(response.message, "Success!");
                                //any other tasks(function) to be run here
                                if (typeof dTable !== 'undefined' && typeof dTable[tblId] !== 'undefined') {
                                    dTable[tblId].ajax.reload((typeof consumeDtableData !== 'undefined') ? consumeDtableData : null, false);
                                }
                                if (typeof reload_data === "function") {
                                    reload_data(tblId.replace("tbl", "form"), response);
                                }
                            }, 1000);
                        } else {
                            toastr.error("", "Operation failed. Reason(s):<ol>" + response.message + "</ol>", "Request failed!");
                        }
                    },
                    'json').fail(function(jqXHR, textStatus, errorThrown) {
                    network_error(jqXHR, textStatus, errorThrown, $("#myform"));
                });
                swal.close();
            });
    }
    //Delete function
    function delete_item(msg, id, url, tblId) {
        swal({
                title: "Are you sure?",
                text: msg,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false
            },
            function() {
                $.post(
                    url, {
                        id: id
                    },
                    function(response) {
                        if (response.success) {
                            setTimeout(function() {
                                toastr.success(response.message, "Success!");
                                //any other tasks(function) to be run here
                                if (typeof dTable !== 'undefined' && typeof dTable[tblId] !== 'undefined') {
                                    dTable[tblId].ajax.reload((typeof consumeDtableData !== 'undefined') ? consumeDtableData : null, false);
                                }
                                if (typeof reload_data === "function") {
                                    reload_data(tblId.replace("tbl", "form"), response);
                                }
                            }, 1000);
                        } else {
                            toastr.error("", "Operation failed. Reason(s):<ol>" + response.message + "</ol>", "Deletion failure!");
                        }
                    },
                    'json').fail(function(jqXHR, textStatus, errorThrown) {
                    network_error(jqXHR, textStatus, errorThrown, $("#myform"));
                });
                swal.close();
            });
    } //End of the deleting function

    //function to format currencies
    function curr_format(n) {
        var formatted = "";
        formatted = (n < 0) ? ("(" + numberWithCommas(n * -1) + ")") : numberWithCommas(n);
        return formatted;
    }

    //function for rounding off currecies
    function round(value, decimals) {
        return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
    }

    //The function for making currency have commas
    function numberWithCommas(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

    // Sums up values in given keys of a multidimensional array
    function sumUp(array_items, sum_key) {
        var total = 0;
        if (array_items.length) {
            $.each(array_items, function(key, array_item) {
                total += parseFloat(array_item[sum_key]);
            });
        }
        return total;
    }

    //register the summing function for dataTables
    jQuery.fn.dataTable.Api.register('sum()', function() {
        return this.flatten().reduce(function(a, b) {
            if (typeof a === 'string') {
                a = a.replace(/[^\d.-]/g, '') * 1;
            }
            if (typeof b === 'string') {
                b = b.replace(/[^\d.-]/g, '') * 1;
            }
            return a + b;
        }, 0);
    });

    //send form data
    $.fn.serializeObject = function() {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    //set options value afterwards
    setOptionValue = function(propId) {
        return function(option, item) {
            if (item === undefined) {
                option.value = "";
            } else {
                option.value = item[propId];
            }
        };
    };
    //return concatenated names of the Member
    function formatMemberDetails(data) {
        if (data.loading) {
            return "No results";
        }
        //return data.salutation + " " + data.firstname + " " + data.lastname + " " + ((data.othernames) ? data.othernames : "") + " - " + data.client_no;
        return formatMember(data);
    }

    function formatMember(member) {
        if (member.id) {
            return member.salutation + " " + member.firstname + " " + member.lastname + " " + ((member.othernames) ? member.othernames : "") + " - " + member.client_no;
        }
        var baseUrl = "--select/search--";
        return baseUrl; /**/
    }

    function network_error(jqXHR, textStatus, errorThrown, formElement) {
        var msg = "Network error. Please check your network/internet connection or get in touch with the admin.";
        status = jqXHR.status;
        switch (status) {
            case 500:
                msg = "There was a server problem.\nPlease report the following message to admin\n" + textStatus;
                break;
            case 404:
                msg = "The operation was unsuccessful.\n Please report the following message to admin\n" + textStatus + "\n" + errorThrown;
                break;
            default:
                break;
        }
        toastr.error(msg, "Deletion failure!");
        console.log("Status : " + textStatus + "\nStatus code: " + status + "\nResponse: " + errorThrown);
        enableDisableButton(formElement, false);
    }

    function enableDisableButton(frm, status) {
        $(frm).find(":input[type=submit], :button[type=submit]").prop("disabled", status);
    }

    function timerIncrement() {
        idleTime = idleTime + 1;
        lock_logout_session(idleTime);
    }

    function lock_logout_session(localIdleTime) {
        // if (localIdleTime > 1) { // After 9 minutes, start polling the server for changes on the idle time from everyone,
        // whilst sending the current tab or window time
        $.ajax({
            url: "<?php echo site_url("welcome/clear_session_id"); ?>",
            type: "POST",
            data: {
                idleTime: localIdleTime
            },
            dataType: 'json',
            success: function(result) {
                idleTime = parseInt(result.idleTime);
                if (idleTime > 15 && idleTime < 31) { //when the overall idleTime is 10 mins, we should lock the screen
                    $('#myLockscreen').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
                } else {
                    if (idleTime === 31) { //log the user out after 30 minutes
                        window.location = "<?php echo site_url("welcome/logout/2"); ?>";
                    }
                    if ($('#myLockscreen').is(':visible')) {
                        $('#myLockscreen').modal('hide');
                    }
                }
            }
        });
        //}

    }

    function daterangepicker_initializer(ranges, min_date, max_date) {
        if (typeof drp !== 'undefined') {
            drp.remove();
        }
        drp = $('#reportrange').data('daterangepicker');
        //Date range picker
        var cb = function(start, end, label) {
            $('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
        };
        optionSet1 = {
            startDate: moment(start_date, 'X'),
            endDate: moment(end_date, 'X'),
            //minDate: '<?php echo date('d-m-Y'); ?>',
            //maxDate: '<?php echo date('d-m-Y'); ?>',
            /*dateLimit: {
             years: 3
             },*/
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'DD-MM-YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Clear',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            },
            ranges: {
                'Today': [moment(), moment()],
                //'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                'Last 60 Days': [moment().subtract(60, 'days'), moment()],
                'Last 90 Days': [moment().subtract(90, 'days'), moment()]
                //,'This Month': [moment().startOf('month'), moment().endOf('month')],
                //'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                ////'Full Records': [moment().subtract(1.5, 'year').startOf('month'), moment()]
            }
        };
        if (typeof ranges !== 'undefined' && ranges !== false) {
            optionSet1['ranges'] = ranges;
        }
        if ((typeof min_date !== 'undefined' && min_date !== false)) {
            optionSet1['minDate'] = min_date;
        }
        if ((typeof max_date !== 'undefined' && max_date !== false)) {
            optionSet1['maxDate'] = max_date;
        }
        $('#reportrange span').html(moment(start_date, 'X').format('MMMM D, YYYY') + ' - ' + moment(end_date, 'X').format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);

        $('#reportrange').on('show.daterangepicker', function() {
            //console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
            //console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            startDate = picker.startDate.format('X');
            endDate = picker.endDate.format('X');
            handleDateRangePicker(startDate, endDate)
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
            //console.log("cancel event fired");
        });
    }
    
    text_truncate = function(str, length, ending) {
    if (length == null) {
      length = 100;
    }
    if (ending == null) {
      ending = '...';
    }
    if (str.length > length) {
      return str.substring(0, length - ending.length) + ending;
    } else {
      return str;
    }
  };
</script>