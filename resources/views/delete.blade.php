<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .hide{
            display: none;
        }

        .show{
            display: block!important;
        }
    </style>
</head>
<body>
    <div style="margin-top: 100px;"></div>
    <div class="container">
        <div class="card d-flex justify-content-center" style="padding: 25px;border-radius:12px;">
            <form action="{{ route("destroy") }}" class="d-flex justify-content-center flex-column align-items-center" method="post">
                @csrf
                <input type="hidden" value="{{ $album["id"] }}" name="id">
                <p class="text-center">من فضلك حدد طريقة الحذف</p>
                <button type="button" class="btn btn-primary-outline text-center"
                 id="btn">هل تريد تحويل الصور الى البوم أخر ؟</button>

                <div class="form-group select-box d-flex justify-content-center">
                    <label for="" class="hide" >اختر الالبوم</label>
                    <select name="album_id" id="convert" class="hide form-control">
                        @foreach (App\Models\Album::all() as $album)
                            <option value="{{ $album->id }}">{{ $album->name }}</option>
                        @endforeach
                    </select>

                    <div id="ele"></div>
                    @foreach ($media as $img)
                        <input type="hidden" name="images[]" value="{{ $img["id"] }}">
                    @endforeach
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" id="convert-btn" class="hide btn-primary">تحويل</button>
                    <button type="submit" id="final" class="btn btn-primary">حذف نهائى</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
    <script>
        document.getElementById("btn").addEventListener("click",function (){
            document.getElementById("convert").classList.add("show")

            document.getElementById("convert-btn").classList.add("show")
            document.getElementById("ele").innerHTML=`<input type="hidden" name="album" value="0"  />`
            document.getElementById("final").setAttribute('disabled', '');

        });
    </script>
</body>
</html>