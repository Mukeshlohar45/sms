$(document).ready(function () {
    $("#updateprofile").click(function(){
        let hobby = [];
        $(':checkbox:checked').each(function(i){
            hobby[i] = $(this).val();
          });
        let obj = {
            id:$("#sid").val(),
            firstname:$("#firstname").val(),   
            lastname:$("#lastname").val(),
            phonenumber:$("#phonenumber").val(),
            gender:$("input[name='gender']:checked").val(),
            hobby:hobby,
            // profile:$("#profile"),
            grade:$('#inpgrade').find(":selected").val()   
        }
        updateData(obj)
    })
});
function updateData(data){
    $.ajax({
        type: 'POST',
        url: 'http://localhost/student_management_system/Controllers/Student/UpdateProfile.php',
        data: JSON.stringify(data),
        success: (res, status) => {
          if (status == "success") {
              window.location.href = "student.php";
          }
        }
    })
}