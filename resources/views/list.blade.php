<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
    <title>dev-codetest</title>
    <style>
        .container {
            max-width: 500px;
        }
        dl, ol, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center mb-5">
                <h2>Gambling.com Group Dev Code Test </h2>
            </div>            
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif
    <div>
        <table class="table table-bordered table-responsive-lg">
            <tr>
                <th>S.No.</th>
                <th>affiliate_id</th>
                <th>name</th>
                <th>latitude</th>
                <th>longitude</th>
                <th>Distance</th>
            </tr>
            @php $i=0; @endphp
            @foreach ($finalData as $data)
                @if(!empty($data['distance']))
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $data['affiliate_id'] }}</td>
                    <td>{{ $data['name'] }}</td>                
                    <td>{{ $data['latitude'] }}</td>
                    <td>{{ $data['longitude'] }}</td>                
                    <td>{{ $data['distance'] }}</td>                
                </tr>
                @endif
            @endforeach
        </table>
    </div>

    </body>
</html>
