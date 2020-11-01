
    /** This Method For Get Related Sections When I Press On Class Select Box In Edit View Of Students **/

    $(document).ready(function(){

        $("#class_id_students").on('change', function(e) {

            let class_id = e.target.value;

            $.get('edit/{id}/section_students?class_id=' + class_id , function(data) {

                $('#section_id_students').empty();

                $('#section_id_students').append(`<option disabled selected> -- Select Section -- </option>`);

                $.each(data, function(index, section) {

                    $('#section_id_students').append($('<option>').text(section.name).attr({'value': section.id}));

                    $('#section_id_students').selectpicker('refresh');

                    $('#section_id_students').selectpicker('render');

                });

            });

        });

    });
