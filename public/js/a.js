/**
 * Created by Me Soe on 2/21/2018.
 */
$(function () {

   $("#myTable").dataTable();

   $("#sale_item").on('keyup',function () {
     setTimeout(function () {
         $("#mySale").submit();
     },2000)
   });

   $("body").delegate('#btnDeleteProduct','click',function () {
      var id=$(this).attr('idd');
      var result=confirm("Are u sure want to delete?");
      if(result){
          $.ajax({
              type: 'get',
              url: 'deleteProduct',
              data: {id:id},
              success:function (msg) {
                  window.location.reload();
              }
          });
      }

   });

    $("#btnNewCategory").on('click',function () {
        var cat_name=$("#cat_name").val();
        var _token=$("#_token").val();

        $.ajax({
            type:'post',
            url:'newCategory',
            data:{cat_name:cat_name,_token:_token},
            success:function (msg) {
                $("#showInfo").html(msg);
                if(msg==="<div class='alert alert-success'>The new category have been created</div>"){
                    setInterval(function () {
                        window.location.reload();
                    },2000)
                }

            }
        })
    });

});