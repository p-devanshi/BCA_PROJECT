<!DOCTYPE html>
<html>
  
<head>
    <!-- Import bootstrap cdn -->
      
    <!-- Import jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity=
"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous">
    </script>
      
    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity=
"sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous">
    </script>
</head>
  
<body>
    <div class="container mt-2">
  
        <!-- Input field to accept user input -->
        Name: <input type="text" name="name" 
            id="name"><br><br>
  
        Marks: <input type="text" name="marks"
            id="marks"><br><br>
  
        <!-- Button to invoke the modal -->
        <button type="button" class="btn btn-primary 
            btn-sm" data-toggle="modal" 
            data-target="#exampleModal"
            id="submit">
            Submit
        </button>
  
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" 
            tabindex="-1" 
            aria-labelledby="exampleModalLabel" 
            aria-hidden="true">
              
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" 
                            id="exampleModalLabel">
                            Confirmation
                        </h5>
                          
                        <button type="button" 
                            class="close" 
                            data-dismiss="modal" 
                            aria-label="Close">
                            <span aria-hidden="true">
                                ×
                            </span>
                        </button>
                    </div>
  
                    <div class="modal-body">
  
                        <!-- Data passed is displayed 
                            in this part of the 
                            modal body -->
                        <h6 id="modal_body"></h6>
                        <button type="button" 
                            class="btn btn-success btn-sm" 
                            data-toggle="modal"
                            data-target="#exampleModal" 
                            id="submit">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <script type="text/javascript">
        $("#submit").click(function () {
            var name = $("#name").val();
            var marks = $("#marks").val();
            var str = "You Have Entered " 
                + "Name: " + name 
                + " and Marks: " + marks;
            $("#modal_body").html(str);
        });
    </script>
</body>
  
</html>