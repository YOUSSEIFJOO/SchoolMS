
    /** This Method For Get Related Sections When I Press On Class Select Box In Create View Of Students Attendance **/

    $(document).ready(function(){

        $("#class_id_attendance").on('change', function(e) {

            let class_id = e.target.value;

            $.get('create/section_attendance?class_id=' + class_id , function(data) {

                $('#section_id_attendance').empty();

                $('#section_id_attendance').append(`<option disabled selected> -- Select Section -- </option><option value=""> No Selected </option>`);

                $.each(data, function(index, section) {

                    $('#section_id_attendance').append($('<option>').text(section.name).attr({'value': section.id}));

                    $('#section_id_attendance').selectpicker('refresh');

                    $('#section_id_attendance').selectpicker('render');

                });

            });

        });

    });
