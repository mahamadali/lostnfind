@extends('backend/app')

@block("title") {{ setting('app.title', 'Social Media') }} @endblock

@block("styles")
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Edit Advertise
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.advertise.update') }}" id="create-advertise-form" enctype="multipart/form-data">
      {{ prevent_csrf() }}
        <input type="hidden" name="id" value="{{ $advertise->id }}" />
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="title" value="{{ $advertise->title }}" />
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label>Description</label>
              <textarea  class="form-control" name="description" >{{ $advertise->description }}</textarea> 
            </div>
          </div>
        </div>

        

        <div class="row">
            <div class="col">
                <div class="form-group">
                <label>Icon</label>
                    <div id="upload_item_images" class="dropzone upload_item_images" style="max-height:500px;overflow:scroll;">
                        <div class="needsclick text-muted">   
                            <div class="desk-create-item">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
          <div class="col">
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg">Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

@endblock

@block("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<script>

Dropzone.autoDiscover = false;  

var myDropzoneNewCollection = new Dropzone(".upload_item_images", {
    url: $( '#create-advertise-form' ).attr('action'),
    autoProcessQueue: false,
    maxFilesize: 500,
    paramName: "files", // The name that will be used to transfer the file
    addRemoveLinks: true,
    uploadMultiple: true,
    maxFiles: 1,
    parallelUploads: 100, 
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.bmp,.heic,.tiff",
    sending: function(file, xhr, formData) {
    // var add_watermark_checked = $('.add_watermark').prop("checked") ? 1 : 0;
    // formData.append('category_id', $( '#create-advertise-form' ).find('select[name="category_id"]').val());
    // formData.append('name', $( '#create-advertise-form' ).find('input[name="name"]').val());
    formData.append('id', $( '#create-advertise-form' ).find('input[name="id"]').val());
    formData.append('title', $( '#create-advertise-form' ).find('input[name="title"]').val());
    formData.append('description', $( '#create-advertise-form' ).find('textarea[name="description"]').val());  
    // formData.append( "data", JSON.stringify($( '#create-advertise-form' ).serializeArray()));
    formData.append('prevent_csrf_token', '{{ prevent_csrf_token() }}');
    },
});

    $('#create-advertise-form').submit(function(e){  
        e.preventDefault();
        if (!myDropzoneNewCollection.files || !myDropzoneNewCollection.files.length) {
            alert('Please Select Picture(s)');
        }else if($( '#create-advertise-form' ).find('input[name="title"]').val() == ''){
          alert('Please enter title');
        }else if($( '#create-advertise-form' ).find('textarea[name="description"]').val() == ''){
            alert('Please enter description');
        } else {
            $('#create-advertise-form').find('button[type="submit"]').html("One moment...beginning to create new item...");
            $('#create-advertise-form').find('button[type="submit"]').prop('disabled', true);
            e.preventDefault();
            // dropzone will now submit the request
            e.stopPropagation();
            myDropzoneNewCollection.processQueue();
        }
    });

    myDropzoneNewCollection.on("successmultiple", function(multiple,xhr) {
      window.location.href='{{ url("admin/advertise/list") }}';
    });

    $(document).ready(function() {
        var itemImages = '<?php echo json_encode($advertise, TRUE) ?>';
        itemImages = $.parseJSON(itemImages);
        fetch(itemImages.full_path)
        .then(res => res.blob())
        .then(blob => {
        let file = new File([blob], itemImages.image_name, blob);
        myDropzoneNewCollection.addFile(file);
        });
    });

   

</script>
@endblock