<main role="main" class="container-flex">
    <form action="#" method = "post" enctype="multipart/form-data">
        <div class="container">
            <div class= "row">
                <div class= "col">
                    <label class="fs-upload_form">Titel</label>
                    <input class= "form-control w-upload_form" name="upload_title" id="title"></textarea>
                </div>
            </div>
            <div class= "row">
                <div class= "col-2">
                    <div class="form-group">
                        <label class="fs-mt-upload_form">Code hochladen</label>
                        <input name="upload_file" type="file" class="form-control-file" id="upload-file">
                    </div>
                    <label class="fs-mt-upload_form">Programmiersprachen</label>
                    <select name="upload_language" id="language" class= "form-control">
                        {pl}
                    </select>
                </div>
            </div>
            <div class= "row">
                <div class= "col">
                    <label class="fs-upload_form"">Beschreibung</label>
                    <textarea class= "form-control w-upload_form" name="upload_description" id="beschreibung" rows="10"></textarea>
                    
                    <input name="upload_tags" class= "form-control mt-upload_form" type= "text" placeholder= "Tags... (mit Komma trennen!)">
                    <button type= "submit" class= "btn btn-primary mt-upload_form">Hochladen</button>
                    <a href= "index.php"><button type="button" class= "btn btn-secondary" id="button-upload_form">Abbruch</button></a>
                </div>
                
            </div>
        </div>
    </form>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
    $('#language').select2({
      placeholder: 'Select a programming language'
    });
    </script>
