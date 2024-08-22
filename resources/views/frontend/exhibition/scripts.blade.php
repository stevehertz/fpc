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
    });
</script>
