<<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Users Data</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body>
   <div class="container">
      <table class="table table-striped">
         <thead>
         <tr>
            <th>ID</th>
            <th>Email</th>
         </tr>
         </thead>
         <tbody>
            @foreach($users as $user)
            <tr>
               <td>{{ $user->id }}</td>
               <td>{{ $user->email }}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
      {{ $users->links() }}
   </div>
</body>
</html>