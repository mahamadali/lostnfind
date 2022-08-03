@extends('backend/app')

@block("title") {{ setting('app.title', 'Social Media') }} @endblock

@block("styles")
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Create Social Media Footer Menu
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.socialmedia.store') }}" id="create-footermenu-form" enctype="multipart/form-data">
      {{ prevent_csrf() }}
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="title" value="{{ old('title') }}" />
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label>Url</label>
              <input type="text" class="form-control" name="url" value="{{ old('url') }}" />
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
      url: $( '#create-footermenu-form' ).attr('action'),
      autoProcessQueue: false,
      maxFilesize: 500,
      paramName: "files", // The name that will be used to transfer the file
      addRemoveLinks: true,
      uploadMultiple: true,
      maxFiles: 1,
      parallelUploads: 1, 
      acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.bmp,.heic,.tiff",
      sending: function(file, xhr, formData) {
      // var add_watermark_checked = $('.add_watermark').prop("checked") ? 1 : 0;
      formData.append('title', $( '#create-footermenu-form' ).find('input[name="title"]').val());
      formData.append('url', $( '#create-footermenu-form' ).find('input[name="url"]').val());
      // formData.append( "data", JSON.stringify($( '#create-footermenu-form' ).serializeArray()));
      formData.append('prevent_csrf_token', '{{ prevent_csrf_token() }}');
      },
  });

  $('#create-footermenu-form').submit(function(e){  
      e.preventDefault();
     
      if (!myDropzoneNewCollection.files || !myDropzoneNewCollection.files.length) {
          alert('Please Select Picture(s)');
      }else if($( '#create-footermenu-form' ).find('input[name="title"]').val() == ''){
          alert('Please enter title');
      }else if($( '#create-footermenu-form' ).find('input[name="url"]').val() == ''){
          alert('Please enter url');
      }else {
          $('#create-footermenu-form').find('button[type="submit"]').html("One moment...beginning to create new item...");
          $('#create-footermenu-form').find('button[type="submit"]').prop('disabled', true);
          e.preventDefault();
          // dropzone will now submit the request
          e.stopPropagation();
          myDropzoneNewCollection.processQueue();
      }
  });

  myDropzoneNewCollection.on("successmultiple", function(multiple,xhr) {
    $('.error-messages').html('');
    var response = $.parseJSON(xhr);
    if(response.status == 200) {
      window.location.href='{{ url("admin/socialmedia/list") }}';
    } else {
      $('#create-footermenu-form').find('button[type="submit"]').html("Submit");
      $('#create-footermenu-form').find('button[type="submit"]').prop('disabled', false);
      $('.error-messages').html('<div class="alert alert-danger"><span>'+response.message+'</span></div>')
      $(window).scrollTop(0);
      myDropzoneNewCollection.removeAllFiles();
    }
  });
</script>
@endblock