
<!DOCTYPE html>
<html lang="en">
<head>
  <title>task 2</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
  <script src="//cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Add new Student</h1>
  <div class="float-right mr-5">
      <a href="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Student</a>
  </div>
</div>
  
{{-- /* Including the sidebar. */ --}}
<div class="container-fluid">
  <div class="row">
    @include('sidebar')
    </div>
  </div>

  {{-- /* The above code is showing the data from the database. */ --}}
  <table class="table" id='myTable'>
    <thead>
    <tr>
      <td>id</td>
      <td>Name</td>
      <td>Image</td>
      <td>Phone</td>
      <td>Course_Name</td>
      <td>Batch_time</td>
      <td>Teaching_Day</td>
      <td>Teacher_Name</td>

      <td>Edit</td>
      <td>Delete</td>
    </tr>
    </thead>
    <tbody>

      @foreach ($students as $c)
      <tr>
        <td>{{ $c->id}}</td>
        <td>{{ $c-> name}}</td>
        <td><img src="{{asset('uploaded_img')}}/{{{$c->img}}}" alt=""height="100" width="100"></td>
        <td>{{ $c-> phone}}</td>
        <td>{{$c->myCourse[0]->Course_Name}}</td>
        <td>{{$c->myCourse[0]->Batch_Time}}</td>
        <td>{{$c->myCourse[0]->Teaching_Day}}</td>
        <td>{{$c->myCourse[0]->Teacher_Name}}</td>

        <td><a href="javascript::void(0)" data-id="{{$c-> course_id}}" class="btn btn-warning showEditModal"  >Edit</a></td>
        <td>
          <form action="student/{{ $c->id}}" method="POST">
          @method('DELETE')
          @csrf
          <input type="submit" value="Delete" class="btn btn-danger">
          </form>
        </td> 
      </tr>
      @endforeach 

    </tbody>
  </table>

</div>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Student</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
     <form action="student" method="post" id="form" enctype="multipart/form-data">
       @csrf

       <div class="form-group">
         <label for="">Name</label>
         <input type="text" class="form-control" name="name" id="name">
       </div>

       <div class="form-group">
        <label for="">phone</label>
        <input type="text" class="form-control" name="phone" id="phone">
      </div>

      <div class="form-group">
        <label for="">Image</label>
        <input type="file" class="form-control" name="img" id="img">
      </div>

      <div class="form-group">
        <label for="">course_id</label>
        {{-- <input type="text" class="form-control" name="course_id" id="course_id"> --}}

       <select name="course_id" id="course_id" class="form-control">
  
        <option selected disabled>---</option>
        @foreach($course  as $cse)
        <option value="{{$cse->id}}">{{$cse->Course_Name}}</option>

        @endforeach
      </select> 

      </div>
      
      <div class="form-group">
        <input type="submit" class="form-control btn btn-success"id="submit" value="Add Student">
      </div>
     </form>

      </div>
    </div>
  </div>
</div>

<a href="/export">Download Data</a>
 




<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );

/* This is a jQuery function that is triggered when the user clicks on the edit button. It is used to
populate the modal with the data of the student that the user wants to edit. */

  $('.showEditModal').click(function(e){
    // teaching_day = e.target.parentElement.previousElementSibling.innerText
   course_id =  e.target.parentElement.previousElementSibling.innerText
   phone =  e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText
   name =  e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText
   id =  e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText
   teacher_name = e.target.parentElement.previousElementSibling.innerText
   course_id =  e.target.getAttribute('data-id')

    $('#course_id').val(course_id);
    $('#phone').val(phone);
    $('#name').val(name);
    $('#teacher_name').val(teacher_name);
 
    $('#submit').val('Edit Student');
    $('.modal-title').text('Edit student');
    $('form').attr('action','student/'+id);
    $('form').append('<input type="hidden" name="_method" value="Put">')
    $('#myModal').modal('show');

  })
</script>

</body>
</html>

