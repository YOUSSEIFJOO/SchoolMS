
    /** This Method For Get Related Sections When I Press On Class Select Box In Edit View Of Teachers **/

    $(document).ready(function(){

        $("#class_id_teachers").on('change', function(e) {

            let class_id = e.target.value;

            $.get('edit/{id}/section_teachers?class_id=' + class_id , function(data) {

                $('#section_id_teachers').empty();

                $('#section_id_teachers').append(`<option disabled selected> -- Select Section -- </option>`);

                $.each(data, function(index, section) {

                    $('#section_id_teachers').append($('<option>').text(section.name).attr({'value': section.id}));

                    $('#section_id_teachers').selectpicker('refresh');

                    $('#section_id_teachers').selectpicker('render');

                });

            });

        });

    });
