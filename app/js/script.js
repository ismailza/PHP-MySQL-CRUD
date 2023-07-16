function get_task(idTask) {
  var data = { idTask: idTask };

  $.ajax({
    url: 'scripts/gettask.php',
    type: 'POST',
    data: JSON.stringify(data),
    contentType: 'application/json; charset=UTF-8',
    success: function(response) {
      var parsedResponse = JSON.parse(response);
      $('#edit-form [name=\"idTask\"]').val(parsedResponse.idTask);
      $('#edit-form [name=\"title\"]').val(parsedResponse.title);
      $('#edit-form [name=\"description\"]').html(parsedResponse.description);
    }
  });

  $('#updateTaskModal').modal('show');
}

function confirm_delete (idTask)
{
  $('#delete-form [name=\"idTask\"]').val(idTask);
  $('#deleteTaskModal').modal('show');
}