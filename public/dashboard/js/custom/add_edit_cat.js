$(document).ready(function () {

    $('.select2').select2();



    $('#section_id').change(function () {
        var section_id = $(this).val();
        $.ajax(
            {
                type:'post',
                url: '/admin/append-categories-level',
                data:{section_id:section_id},
                success:function (res) {
                    $('#appendCategoriesLevel').html(res);
                },
                error:function () {
                    alert("error");
                }
            }
        )
    })


});
