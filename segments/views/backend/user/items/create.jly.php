@extends('backend/app')

@block("title") {{ setting('app.title', 'Quotations') }} @endblock

@block("styles")
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
@endblock

@block("content")

  <div class="card card-inverse-light-with-black-text flatten-border">
    <div class="card-header">
      Create Item
    </div>
    <div class="card-body">
      <div class="error-messages"></div>
      <form method="post" action="{{ route('user.items.store') }}" id="create-item-form" enctype="multipart/form-data">
      {{ prevent_csrf() }}
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Tag Number</label>
              <input type="text" class="form-control" name="tag_number" id="tag_number" required>
              <input type="hidden" name="category_id" id="category_id" value="">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" required/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" name="description" id="description" cols="5" rows="5">{{ old('description') }}</textarea>
            </div>
          </div>
        </div>

        <div class="row pet_section">
          <div class="col">
            <div class="form-group">
              <label>Breed</label>
              <input type="text" name="breed" class="form-control" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Preferred Pet Food</label>
              <input type="text" name="preferred_pet_food" class="form-control" />
            </div>
          </div>
        </div>

        <div class="row pet_section">
          <div class="col">
            <div class="form-group">
              <label>Any Distinguishing Marks</label>
              <input type="text" name="distinguishing_marks" class="form-control" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Additional Notes</label>
              <input type="text" name="notes" class="form-control" />
            </div>
          </div>
        </div>

        <div class="row pet_section">
          <div class="col">
            <div class="form-group">
              <label>Date Of Birth</label>
              <input type="date" name="date_of_birth" class="form-control" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Gender</label><br>
              <input type="radio" name="gender" id="gender" value="Male"  /> Male
              <input type="radio" name="gender" id="gender" value="Female"  /> Female
            </div>
          </div>
        </div>

        <div class="row pet_section">
          <div class="col">
            <div class="form-group">
              <label>Height</label>
              <input type="text" name="height" class="form-control" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Weight</label>
              <input type="text" name="weight" class="form-control" />
            </div>
          </div>
        </div>

        <div class="row pet_section">
          <div class="col">
            <div class="form-group">
              <label>Length</label>
              <input type="text" name="length" class="form-control" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Type</label>
              <input type="text" name="type" class="form-control" />
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                <label>Item Images</label>
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
<script src="https://cdn.tiny.cloud/1/1oygzsxmj2z65b12oe2xsmopyeb339ctejhzi5fgpu8ftp4r/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
 
 tinymce.init({
  selector:'textarea',
  menubar :false,
}); 

Dropzone.autoDiscover = false;  

var myDropzoneNewCollection = new Dropzone(".upload_item_images", {
    url: $( '#create-item-form' ).attr('action'),
    autoProcessQueue: false,
    maxFilesize: 500,
    paramName: "files", // The name that will be used to transfer the file
    addRemoveLinks: true,
    uploadMultiple: true,
    parallelUploads: 100, 
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.bmp,.heic,.tiff",
    sending: function(file, xhr, formData) {
    // var add_watermark_checked = $('.add_watermark').prop("checked") ? 1 : 0;
    // formData.append('category_id', $( '#create-item-form' ).find('select[name="category_id"]').val());
    // formData.append('name', $( '#create-item-form' ).find('input[name="name"]').val());
    tinyMCE.get("description").save();
    formData.append( "data", JSON.stringify($( '#create-item-form' ).serializeArray()));
    },
});

$('#create-item-form').submit(function(e){  
    e.preventDefault();
    if (!myDropzoneNewCollection.files || !myDropzoneNewCollection.files.length) {
        alert('Please Select Picture(s)');
    } else {
        $('#create-item-form').find('button[type="submit"]').html("One moment...beginning to create new item...");
        $('#create-item-form').find('button[type="submit"]').prop('disabled', true);
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
    window.location.href='{{ url("user/items") }}';
  } else {
    $('#create-item-form').find('button[type="submit"]').html("Submit");
    $('#create-item-form').find('button[type="submit"]').prop('disabled', false);
    $('.error-messages').html('<div class="alert alert-danger"><span>'+response.message+'</span></div>')
    $(window).scrollTop(0);
    myDropzoneNewCollection.removeAllFiles();
  }
});

$(document).ready(function(){
  $('.pet_section').hide();

  $('#tag_number').on('blur', function() {
    $.ajax({
      url: '{{ route("user.items.checkTag"); }}',
      type: 'post',
      data: {
        tag_number: $(this).val()
      },
      dataType: 'json',
      success: function(response) {
        $('.error-messages').html('');
        if(response.status == 200) {
          $('#category_id').val(response.tag.category_id);
          $('#category_id').attr('data-category_name', response.tag.category.title);
        } else {
          $('.error-messages').html('<div class="alert alert-danger"><span>'+response.message+'</span></div>')
          $('#category_id').val('');
          $('#category_id').attr('data-category_name', '');
        }
        $('#category_id').change();
      }
    });
  });
})

$('#category_id').change(function(){
  var category = $(this).attr("data-category_name");
  if(category == 'Pets'){
    $('.pet_section').show();
  }else{
    $('.pet_section').hide();
  }
})
</script>
@endblock