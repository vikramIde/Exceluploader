<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> -->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
       <script>
            $(document).ready(function(){
                function statusUpdater() {
                        $('.status').html('<span style="color:red">Uploading In progress ...</span>');
                                console.log('statusUpdater Initiated');
                        $.ajax({
                            'url':'status',
                        }).done(function(r) {
                        if(r.msg==='done') {
                                $('.status').html('<span style="color:green">Finished Uploading</span>');
                                console.log( "The import is completed. Your data is now available for viewing ... " );
                        } else {

                        $('.progress-bar').css('width', r.msg+'%').attr('aria-valuenow', r.msg); 
                        
                            statusUpdater();
                        }
                        })
                        .fail(function() {
                                console.log( "An error has occurred... We could ask Neo about what happened, but he's taken the red pill and he's at home sleeping" );
                        });
                }
           statusUpdater();
            });
        </script>

    </head>
    <body>
        
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3">Upload Excel Demo!</h1>
        <p>This app is running the uploading code in a seperate process in background . There is an ajax call which calls a status function and update the status of the file being uploaded</p>
        
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        <script type="text/javascript">
                        $(document).ready(function(){
                             location.reload();
                         });
                        </script>
                    @endif
                @endforeach
            </div>

            <form class="form-inline" method="post" enctype="multipart/form-data" action="uploadExcel" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" name="fileExcel" class="form-control-file" >
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <br/>

             <h2>Progress Bar</h2>
                  <span class="status"></span>
                  <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                          <span class="sr-only">70% Complete</span>
                        </div>
                  </div>
         
        </div>
        
      </div>

  <hr>

      <footer>
        <p>&copy; Company 2016</p>
      </footer>
    </div> 
        
    </body>

        
</html>
