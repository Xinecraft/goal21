(function ($) {
    'use strict';
    $(function () {
        var sidebar = $('.sidebar');

        //Add active class to nav-link based on url dynamically
        //Active class can be hard coded directly in html file also as required
        var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
        /*$('.nav li a', sidebar).each(function () {
            var $this = $(this);
            if (current === "")
            {
                //for root url
                if ($this.attr('href').indexOf("dashboard/") === -1) {
                    $(this).parents('.nav-item').last().addClass('active');
                    if ($(this).parents('.sub-menu').length) {
                        $(this).closest('.collapse').addClass('show');
                        $(this).addClass('active');
                    }
                }
            } else {
                //for other url
                if ($this.attr('href').indexOf(current) !== -1) {
                    $(this).parents('.nav-item').last().addClass('active');
                    if ($(this).parents('.sub-menu').length) {
                        $(this).closest('.collapse').addClass('show');
                        $(this).addClass('active');
                    }
                }
            }
        });*/

        //Close other submenu in sidebar on opening any

        sidebar.on('show.bs.collapse', '.collapse', function () {
            sidebar.find('.collapse.show').collapse('hide');
        });


        //Change sidebar and content-wrapper height
        applyStyles();

        function applyStyles() {
            //Applying perfect scrollbar
            if ($('.scroll-container').length) {
                const ScrollContainer = new PerfectScrollbar('.scroll-container');
            }
        }

        //checkbox and radios
        $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');


        $(".purchace-popup .popup-dismiss").on("click", function () {
            $(".purchace-popup").slideToggle();
        });
    });

    $('button.confirmit').on('click', function (event) {
        // Display SweetAlert
        // On clicking 'Yes, I am sure to delete'
        if( jQuery('input:invalid').length <= 0)
        {
            event.preventDefault();
            swal({
                title: $(this).data('confirm-title') ? $(this).data('confirm-title') : "Are you sure?",
                text: $(this).data('confirm-text') ? $(this).data('confirm-text') : "You will not be able to undo this. Are you sure you wanna perform this operation?",
                type: $(this).data('confirm-type') ? $(this).data('confirm-type') : "warning",
                showCancelButton: true,
                confirmButtonColor: $(this).data('confirm-btncolor') ? $(this).data('confirm-btncolor') : "#DD6B55",
                confirmButtonText: $(this).data('confirm-btntext') ? $(this).data('confirm-btntext') : "Yes, Do It!",
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    //$('.delete-confirm').closest('form').submit();
                    $(this).closest('form').submit();
                }
            });
        }
    });

    // Enable Tooltip everywhere
    $('[data-toggle="tooltip"]').tooltip()

    /*const inputSelector = ':input[required]:visible';
    function checkForm() {
        // here, "this" is an input element
        var isValidForm = true;
        $(this.form).find(inputSelector).each(function () {
            if (!this.value.trim()) {
                isValidForm = false;
            }
        });
        $(this.form).find('.monitored-btn').prop('disabled', !isValidForm);
        return isValidForm;
    }
    $('.monitored-btn').closest('form')
    // in a user hacked to remove "disabled" attribute, also monitor the submit event
        .submit(function () {
            // launch checkForm for the first encountered input,
            // use its return value to prevent default if form is not valid
            return checkForm.apply($(this).find(':input')[0]);
        })
        .find(inputSelector).keyup(checkForm).keyup();*/

})(jQuery);
