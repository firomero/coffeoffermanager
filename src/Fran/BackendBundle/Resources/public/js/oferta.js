/**
 * Created by firomero on 11/05/2015.
 */
$(function(){
    $(document).ready(function() {

        $('#tabla').DataTable(
            {
                "oLanguage":$language,
//                        "bJQueryUI": true,
                "aLengthMenu": [5, 10, 15]
            }
        );
    } );
})