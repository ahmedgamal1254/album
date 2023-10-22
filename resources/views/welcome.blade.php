<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Album Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                <td>
                    {{-- @if (!empty($album->media))                        
                        <img src="{{asset("storage/app/".$album->media[0]['disk'].'/'.$album->media[0]['id'].'/'.$album->media[0]['file_name']) }}"
                        style="width:70px;height:70px;"
                        alt="" srcset="">
                    @endif --}}
                </td>
                <td>
                    <a href="{{ route("show",$album->id) }}" class="btn btn-success">عرض</a>
                    <a href="{{ route("edit",$album->id) }}" class="btn btn-primary">تعديل</a>                  
                    <a href="{{ route("delete",$album->id) }}" class="btn btn-primary">حذف</a>                  
                </td>
              </tr>

          @endforeach
        </tbody>
      </table>

      <a href="{{ route("create") }}" class="btn btn-primary">اضافة البوم جديد</a>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        document.getElementById("btn").addEventListener("click",function (){
            document.getElementById("select-box").innerHTML=`
            <select name="album_id">
               <option>ahmed</option>
            </select>
            `
        })
    </script>
</body>
</html>