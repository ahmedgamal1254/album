<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Album Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">اسم الالبوم</th>
            <th scope="col">الصور</th>
            <th scope="col">العمليات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($albums as $album)
              <tr>
                <td>{{ $album->id }}</td>
                <td>{{ $album->name }}</td>
                <td><img src="{{asset("storage/app/".$album->media[0]['disk'].'/'.$album->media[0]['id'].'/'.$album->media[0]['file_name']) }}"
                    style="width:70px;height:70px;"
                     alt="" srcset=""></td>
                <td>
                    <a href="{{ route("show",$album->id) }}" class="btn btn-success">عرض</a>
                    <a href="{{ route("edit",$album->id) }}" class="btn btn-primary">تعديل</a>

                </td>
              </tr>

          @endforeach
        </tbody>
      </table>

      <a href="{{ route("create") }}" class="btn btn-primary">اضافة البوم جديد</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>