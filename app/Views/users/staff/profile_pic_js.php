        var i_d = "<?php echo isset($user['id'])?$user['id']:'' ?>";
        var firm = "<?php echo isset($user['firm_id'])?$user['firm_id']:''; ?>";
        var user_name = "<?php echo isset($user['first_name'])?$user['first_name']."_".$user['last_name']:''; ?>";
            var $uploadCrop,
                tempFilename,
                rawImg,
                imageId;
        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.upload-sh').addClass('ready');
                    $('#cropImagePop').modal('show');
                    rawImg = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        $uploadCrop = $('#upload-sh').croppie({
            viewport: {
                width: 200,
                height: 200, type: 'square'
            },
            enforceBoundary: false,
            enableExif: true
        });
        $('#cropImagePop').on('shown.bs.modal', function () {
                $uploadCrop.croppie('bind', {
                url: rawImg
            });
        });

        $('.item-img').on('change', function () {
            imageId = $(this).data('id');
            tempFilename = $(this).val();
            $('#cancelCropBtn').data('id', imageId);
            readFile(this);
        });
        $('#cropImageBtn').on('click', function (ev) {
            ;
            $uploadCrop.croppie('result', {
                type: 'base64',
                format: 'jpeg',
                size: {width: 200, height: 200}
            }).then(function (resp) {
                $('#item-img-output').attr('src', resp);
                $('#cropImagePop').modal('hide');

                $.post('<?php echo site_url("staff/add_profile_pic"); ?>',
                        {image: resp, i_d: i_d,user_name:user_name,firm:firm},
                        function (feedback) {
                            toastr.success(feedback.message, "Success");
                        });

            });
        });
