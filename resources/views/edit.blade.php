<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Album</title>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .upload-files-container {
            background-color: #f7fff7;
            width: 420px;
            padding: 30px 60px;
            border-radius: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 10px 20px, rgba(0, 0, 0, 0.28) 0px 6px 6px;
        }
        .drag-file-area {
            border: 2px dashed #7b2cbf;
            border-radius: 40px;
            margin: 10px 0 15px;
            padding: 30px 50px;
            width: 350px;
            text-align: center;
        }
        .drag-file-area .upload-icon {
            font-size: 50px;
        }
        .drag-file-area h3 {
            font-size: 26px;
            margin: 15px 0;
        }
        .drag-file-area label {
            font-size: 19px;
        }
        .drag-file-area label .browse-files-text {
            color: #7b2cbf;
            font-weight: bolder;
            cursor: pointer;
        }
        .browse-files span {
            position: relative;
            top: -25px;
        }
        .default-file-input {
            opacity: 0;
        }
        .cannot-upload-message {
            background-color: #ffc6c4;
            font-size: 17px;
            display: flex;
            align-items: center;
            margin: 5px 0;
            padding: 5px 10px 5px 30px;
            border-radius: 5px;
            color: #BB0000;
            display: none;
        }
        @keyframes fadeIn {
        0% {opacity: 0;}
        100% {opacity: 1;}
        }
        .cannot-upload-message span, .upload-button-icon {
            padding-right: 10px;
        }
        .cannot-upload-message span:last-child {
            padding-left: 20px;
            cursor: pointer;
        }
        .file-block {
            color: #f7fff7;
            background-color: #7b2cbf;
            transition: all 1s;
            width: 390px;
            position: relative;
            display: none;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0 15px;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
        }
        .file-info {
            display: flex;
            align-items: center;
            font-size: 15px;
        }
        .file-icon {
            margin-right: 10px;
        }
        .file-name, .file-size {
            padding: 0 3px;
        }
        .remove-file-icon {
            cursor: pointer;
        }
        .progress-bar {
            display: flex;
            position: absolute;
            bottom: 0;
            left: 4.5%;
            width: 0;
            height: 5px;
            border-radius: 25px;
            background-color: #4BB543;
        }
    </style>
</head>
<body>
    <div style="margin-top: 100px;"></div>
    <div class="container">
        <div class="alert alert-success text-center">تعديل صور الالبوم {{ $album->name }}</div>
        <div class="d-flex justify-content-center align-items-sm-center">
            <form action="{{ route("update") }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $album->id }}">
                <div class="form-group" style="margin:20px 0;">
                    <input type="text" name="name" value="{{ $album->name }}" class="form-control" placeholder="enter name of album" />
                </div>

                <div class="upload-files-container">
                    <div class="drag-file-area">
                        <span class="material-icons-outlined upload-icon"> file_upload </span>
                        <h3 class="dynamic-message"> ارفع صور الالبوم لديك</h3>
                        <label class="label"> or <span class="browse-files"> <input type="file" multiple name="images[]" class="default-file-input"/> <span class="browse-files-text">browse file</span> <span>from device</span> </span> </label>
                    </div>
                    <span class="cannot-upload-message"> <span class="material-icons-outlined">error</span> Please select a file first <span class="material-icons-outlined cancel-alert-button">cancel</span> </span>
                    <div class="file-block">
                        <div class="file-info"> <span class="material-icons-outlined file-icon">description</span> <span class="file-name"> </span> | <span class="file-size">  </span> </div>
                        <span class="material-icons remove-file-icon">delete</span>
                        <div class="progress-bar"> </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">حفظ</button>

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        var isAdvancedUpload = function() {
          var div = document.createElement('div');
          return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
        }();

        let draggableFileArea = document.querySelector(".drag-file-area");
        let browseFileText = document.querySelector(".browse-files");
        let uploadIcon = document.querySelector(".upload-icon");
        let dragDropText = document.querySelector(".dynamic-message");
        let fileInput = document.querySelector(".default-file-input");
        let cannotUploadMessage = document.querySelector(".cannot-upload-message");
        let cancelAlertButton = document.querySelector(".cancel-alert-button");
        let uploadedFile = document.querySelector(".file-block");
        let fileName = document.querySelector(".file-name");
        let fileSize = document.querySelector(".file-size");
        let progressBar = document.querySelector(".progress-bar");
        let removeFileButton = document.querySelector(".remove-file-icon");
        let uploadButton = document.querySelector(".upload-button");
        let fileFlag = 0;

        fileInput.addEventListener("click", () => {
            fileInput.value = '';
            console.log(fileInput.value);
        });

        fileInput.addEventListener("change", e => {
            console.log(" > " + fileInput.value)
            uploadIcon.innerHTML = 'check_circle';
            dragDropText.innerHTML = 'File Dropped Successfully!';
            document.querySelector(".label").innerHTML = `drag & drop or <span class="browse-files"> <input type="file" class="default-file-input" style=""/> <span class="browse-files-text" style="top: 0;"> browse file</span></span>`;
            uploadButton.innerHTML = `Upload`;
            fileName.innerHTML = fileInput.files[0].name;
            fileSize.innerHTML = (fileInput.files[0].size/1024).toFixed(1) + " KB";
            uploadedFile.style.cssText = "display: flex;";
            progressBar.style.width = 0;
            fileFlag = 0;
        });

        uploadButton.addEventListener("click", () => {
            let isFileUploaded = fileInput.value;
            if(isFileUploaded != '') {
                if (fileFlag == 0) {
                    fileFlag = 1;
                    var width = 0;
                    var id = setInterval(frame, 50);
                    function frame() {
                        if (width >= 390) {
                            clearInterval(id);
                            uploadButton.innerHTML = `<span class="material-icons-outlined upload-button-icon"> check_circle </span> Uploaded`;
                        } else {
                            width += 5;
                            progressBar.style.width = width + "px";
                        }
                    }
                }
            } else {
                cannotUploadMessage.style.cssText = "display: flex; animation: fadeIn linear 1.5s;";
            }
        });

        cancelAlertButton.addEventListener("click", () => {
            cannotUploadMessage.style.cssText = "display: none;";
        });

        if(isAdvancedUpload) {
            ["drag", "dragstart", "dragend", "dragover", "dragenter", "dragleave", "drop"].forEach( evt => 
                draggableFileArea.addEventListener(evt, e => {
                    e.preventDefault();
                    e.stopPropagation();
                })
            );

            ["dragover", "dragenter"].forEach( evt => {
                draggableFileArea.addEventListener(evt, e => {
                    e.preventDefault();
                    e.stopPropagation();
                    uploadIcon.innerHTML = 'file_download';
                    dragDropText.innerHTML = 'Drop your file here!';
                });
            });

            draggableFileArea.addEventListener("drop", e => {
                uploadIcon.innerHTML = 'check_circle';
                dragDropText.innerHTML = 'File Dropped Successfully!';
                document.querySelector(".label").innerHTML = `drag & drop or <span class="browse-files"> <input type="file" class="default-file-input" style=""/> <span class="browse-files-text" style="top: -23px; left: -20px;"> browse file</span> </span>`;
                uploadButton.innerHTML = `Upload`;
                
                let files = e.dataTransfer.files;
                fileInput.files = files;
                console.log(files[0].name + " " + files[0].size);
                console.log(document.querySelector(".default-file-input").value);
                fileName.innerHTML = files[0].name;
                fileSize.innerHTML = (files[0].size/1024).toFixed(1) + " KB";
                uploadedFile.style.cssText = "display: flex;";
                progressBar.style.width = 0;
                fileFlag = 0;
            });
        }

        removeFileButton.addEventListener("click", () => {
            uploadedFile.style.cssText = "display: none;";
            fileInput.value = '';
            uploadIcon.innerHTML = 'file_upload';
            dragDropText.innerHTML = 'Drag & drop any file here';
            document.querySelector(".label").innerHTML = `or <span class="browse-files"> <input type="file" class="default-file-input"/> <span class="browse-files-text">browse file</span> <span>from device</span> </span>`;
            uploadButton.innerHTML = `Upload`;
        });
    </script>
</body>
</html>