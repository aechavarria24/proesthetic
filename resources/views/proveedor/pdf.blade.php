<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title></title>
  </head>
  <body>
    {{ date('Y-m-d')}}
<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Telefono</th>
    </tr>
  </thead>

  <tbody>
@foreach ($producto as $key => $value)

  <tr>
<td>{{value->nombre}}</td>
<td>{{value->telefono}}</td>
  </tr>

@endforeach
  </tbody>
</table>
  </body>
</html>
