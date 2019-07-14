@extends('admin::layout')

@section('title')
    Cropper
@endsection

@section('content')
    <style type="text/css">
        .crop-tool {
            max-width: 100%;
        }
        .crop-tool img {
            width: 100%;
        }
    </style>

    <div class="row">
        <div class="col-md-4">
            <div style="width: 200px;">
                <img src="uploads/sample01_600x600.jpg">
            </div>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cropModal" data-image-url="uploads/sample01_600x600.jpg">
                Edit image
            </button>
        </div>
        <div class="col-md-4">
            <div style="width: 200px;">
                <img src="uploads/sample02_600x600.jpg">
            </div>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cropModal" data-image-url="uploads/sample02_600x600.jpg">
                Edit image
            </button>
        </div>
        <div class="col-md-4">
            <div style="width: 200px;">
                <img src="uploads/sample03_600x600.jpg">
            </div>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cropModal" data-image-url="uploads/sample03_600x600.jpg">
                Edit image
            </button>
        </div>
    </div>

    <div class="modal fade" id="cropModal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="cropModalLabel">Edit image</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="crop-tool" style="background: lightgreen;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="crop-preview" style="background: salmon;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // JS Cropper
        $(function() {
            $("#cropModal").on("hide.bs.modal", function() {
                $(".crop-tool").empty();
                $(".crop-preview").empty();
            });

            $('#cropModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let imageUrl = button.data('image-url');
                let modal = $(this);

                let image = $('<img />', {
                    id: 'croppedImage',
                    src: imageUrl
                });

                modal.find('.modal-body .crop-tool').append(image);

                let originalData = {};

                image.cropper({
                    autoCrop : true,
                    aspectRatio: 200/160,
                    minCropBoxWidth: 200,
                    minCropBoxHeight: 160,
                    strict: true,
                    resizable: true,
                    zoomable: false,
                    rotatable: false,
                    multiple: true,
                    viewMode: 2,
                    minContainerWidth: '415',
                    minContainerHeight: '415',
                    highlight: true,
                    crop: function(event) {
                        originalData = image.cropper("getCroppedCanvas", {width: "200", height: "160"});
                        let cropPreview = originalData.toDataURL();
                        $('.crop-preview').empty().append('<img src="' + cropPreview + '" width="415" >');

                        // $('.crop-preview').empty().append('<img src="' + cropPreview + '">');
                        // $('.crop-preview').empty().append('<img src="' + cropPreview + '" width="415" height="415">');

                        // console.log(event.detail.x);
                        // console.log(event.detail.y);
                        // console.log(event.detail.width);
                        // console.log(event.detail.height);
                        // console.log(event.detail.scaleX);
                        // console.log(event.detail.scaleY);
                    }
                });
            });
        });
    </script>
@endsection