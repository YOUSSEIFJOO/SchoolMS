
    /** This Method For Get Related Sections When I Press On Class Select Box In Create View Of Students **/

    $(document).ready(function(){

        $("#section_id_teachers").on('change', function(e) {

            let section_id = e.target.value;

            $.get('create/subject_teachers?section_id=' + section_id , function(data) {

                $('#subject_id_teachers').empty();

                $('#subject_id_teachers').append(`<option disabled selected> -- Select Subject -- </option>`);

                $.each(data, function(index, subject) {

                    $('#subject_id_teachers').append($('<option>').text(subject.name).attr({'value': subject.id}));

                    $('#subject_id_teachers').selectpicker('refresh');

                    $('#subject_id_teachers').selectpicker('render');

                });

            });

        });

    });
