//
// $(document).ready(function(){
//
//       $("button").click(function(){
//
//         var rowId = $(this).attr('id');
//
//             var doorName = $("#text-"+rowID).text();
//
//             rowData = {
//                 lock_name: rowId,
//                 lock_text: doorName
//             };
//
//             $.ajax({
//                 url: 'update_row_name.php',
//                 type:'post',
//                 data:rowData,
//                 success: function(response) {
//                     alert(response);
//                 }
//             });
//
//       });
//
// });
