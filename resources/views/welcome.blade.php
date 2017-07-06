<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <!-- Styles -->
        <style>
           
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="row">
                    <div class="col-lg-10 col-sm-10 col-lg-offset-1 col-sm-offset-1">
                        <div class="links" >
                            <a href="{{ URL::to('/status.html') }}"><h1>View Status API</h1></a>
                        </div>
                        
                        <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Method</th>
                            <th>URL</th>
                            <th>Description</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>GET</td>
                            <td>{{ URL::to('/api/status') }}</td>
                            <td>List all status</td>
                          </tr>
                          <tr>
                            <td>GET</td>
                            <td>{{ URL::to('/api/status/{id}') }}</td>
                            <td>View status</td>
                          </tr>
                          <tr>
                            <td>POST</td>
                            <td>{{ URL::to('/api/status') }}</td>
                            <td>insert status</td>
                          </tr>
                          <tr>
                            <td>PUT</td>
                            <td>{{ URL::to('/api/status') }}</td>
                            <td>Update status</td>
                          </tr>
                          <tr>
                            <td>DELETE</td>
                            <td>{{ URL::to('/api/status/{id}') }}</td>
                            <td>Delete status</td>
                          </tr>
                          <tr>
                            <td>GET</td>
                            <td>{{ URL::to('/api/status/page/{pageid}/item/{limit}/{key}') }}</td>
                            <td>Search status with pagination</td>
                          </tr>
                        </tbody>
                      </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
