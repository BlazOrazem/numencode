@php($inline = isset($inline))
@php($required = isset($required))
@php($fieldId = Str::camel($field) . '-' . Str::random(10))

<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}{{ $required ? ' has-icon' : '' }}">

    @if($inline)

        <div class="p-relative">
            @if(isset($label))
                <label for="{{ $fieldId }}" class="control-label{{ !$inline ? ' col-sm-3' : '' }}">
                    {{ $label }}
                </label>
            @endif

            @if(isset($entity) && $entity->$field)
                <img src="{{ $entity->$field }}" class="img-thumbnail" style="height: 44px;">
            @endif

            <input type="file"
                   name="{{ $field }}"
                   value="{{ old($field) }}"
                   class="form-control{{ isset($class) ? ' ' . $class : '' }}"
                   id="{{ $fieldId }}"
            >
            @if($required)
                <span class="zmdi zmdi-star-outline f-s-18 form-icon"></span>
            @endif
        </div>

        <span class="help-block">
            {!! isset($help) ? $help . '</br>' : '' !!}
            {{ $errors->first($field, ':message') }}
        </span>

    @else

        @if(isset($label))
            <label for="{{ $fieldId }}" class="control-label{{ !$inline ? ' col-sm-3' : '' }}">
                {{ $label }}
            </label>
        @endif

        <div class="col-sm-9">
            <div class="p-relative">
                <input type="file"
                       name="{{ $field }}"
                       value="{{ old($field) }}"
                       class="form-control{{ isset($class) ? ' ' . $class : '' }}"
                       id="{{ $fieldId }}"
                >
                @if($required)
                    <span class="zmdi zmdi-star-outline f-s-18 form-icon"></span>
                @endif
            </div>

            <span class="help-block">
                {!! isset($help) ? $help . '</br>' : '' !!}
                {{ $errors->first($field, ':message') }}
            </span>

            @if(isset($entity) && $entity->$field)
                <img src="{{ $entity->$field }}" class="img-responsive img-thumbnail" style="max-height: 300px;">
                <br class="clearfix">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cropModal" data-image-url="{{ $entity->$field }}">
                    Edit image
                </button>
                <br />
            @endif
        </div>

    @endif

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

<style type="text/css">
    .crop-tool {
        max-width: 100%;
    }
    .crop-tool img {
        width: 100%;
    }
</style>

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
                    aspectRatio: 4/3,
                    resizable: true,
                    zoomable: false,
                    rotatable: false,
                    multiple: true,
                    viewMode: 2,
                    minContainerWidth: '400',
                    minContainerHeight: '300',
                    crop: function(event) {
                        originalData = image.cropper("getCroppedCanvas");
                        let cropPreview = originalData.toDataURL();
                        $('.crop-preview').empty().append('<img src="' + cropPreview + '" width="400" height="300">');
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