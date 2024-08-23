<script>
    $(document).ready(function() {
        let currentStep = 0;
        let formSteps = $('.form-step');

        // Initialize the first step as active
        $(formSteps[currentStep]).addClass('active');

        $('.next-step').on('click', function(e) {
            e.preventDefault();
            if (validateFormStep(currentStep)) {
                $(formSteps[currentStep]).removeClass('active');
                currentStep++;
                $(formSteps[currentStep]).addClass('active');
            }
        });

        $('.previous-step').on('click', function() {
            $(formSteps[currentStep]).removeClass('active');
            currentStep--;
            $(formSteps[currentStep]).addClass('active');
        });

        function validateFormStep(step) {
            var valid = true;
            $(formSteps[step]).find('input[required]').each(function() {
                if (!$(this).val()) {
                    valid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            return valid;
        }

        // submit form
        $('#registerExhibitionForm').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let formData = new FormData(form[0]);
            let path = '{{ route('exhibition.register') }}';
            $.ajax({
                type: "POST",
                url: path,
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function() {
                    form.find('button[type=submit]').html(
                        '<i class="fa fa-spinner fa-spin"></i>'
                    );
                    form.find('button[type=submit]').attr('disabled', true);
                },
                complete: function() {
                    form.find('button[type=submit]').html(
                        'Register'
                    );
                    form.find('button[type=submit]').attr('disabled', false);
                },
                success: function(data) {
                    if (data['status']) {
                        toastr.success(data['message']);
                        setTimeout(() => {
                            window.location.href =
                                '{{ route('home') }}'
                        }, 1000);
                    } else {
                        toastr.error(data['message']);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    var errorsHtml = '<ul>';
                    $.each(errors['errors'], function(key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                    errorsHtml += '</ul>';
                    toastr.error(errorsHtml);
                }
            });
        });
    });
</script>
