
    /** This Method For Check The Attendance And Put It Value In textCheckbox **/

    $(document).ready(function(){

        $('p.alert').fadeIn().delay(1000).fadeOut();

        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        $("#checkboxCreate[type=checkbox]").each(function() {

            $(this).change(function () {

                if($(this).is(":checked")) {

                    $(this).prev("#textCheckbox").attr("value", "present");

                } else {

                    $(this).prev("#textCheckbox").attr("value", "absent");

                }

            });

        });

    });
