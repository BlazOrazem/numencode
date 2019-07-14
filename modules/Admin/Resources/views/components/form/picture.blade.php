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
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ $entity->$field }}" class="img-responsive img-thumbnail">
                    </div>
                    <div class="col-md-6">
                        <hr />
                        @if(isset($plugin) && config("images.$plugin"))
                            @foreach(config("images.$plugin.crops") as $cropPath => $dimensions)
                                <button type="button"
                                        class="btn btn-info"
                                        data-toggle="modal"
                                        data-target="#cropModal"
                                        data-image-path="{{ $entity->$field }}"
                                        data-crop-width="{{ $dimensions['width'] }}"
                                        data-crop-height="{{ $dimensions['height'] }}"
                                        data-crop-path="{{ $plugin . '/' . $cropPath }}">
                                    Edit {{ str_replace('_', ' ', $cropPath) }}
                                </button>
                                <hr />
                            @endforeach
                        @endif
                    </div>
                </div>
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
                        <div class="crop-tool"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="crop-preview"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="jsCloseCrop">Close</button>
                <button type="button" class="btn btn-success" id="jsSaveCrop">Save changes</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        // JS Cropper
        $(function() {
            $("#cropModal").on("hide.bs.modal", function() {
                $(".crop-tool").empty();
                $(".crop-preview").empty();
            });

            $('#cropModal').on('show.bs.modal', function (event) {
                let modal = $(this);
                let button = $(event.relatedTarget);
                let imagePath = button.data('image-path');
                let cropPath = button.data('crop-path');
                let cropWidth = button.data('crop-width');
                let cropHeight = button.data('crop-height');

                let image = $('<img />', {
                    id: 'croppedImage',
                    src: imagePath
                });

                modal.find('.modal-body .crop-tool').append(image);

                image.cropper({
                    autoCrop : true,
                    aspectRatio: cropWidth/cropHeight,
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
                        let originalData = image.cropper("getCroppedCanvas", {width: cropWidth, height: cropHeight});
                        let cropPreview = originalData.toDataURL();
                        $('.crop-preview').empty().append('<img src="' + cropPreview + '" width="415">');
                    }
                });

                modal.find('#jsSaveCrop').on('click', function() {
                    let originalData = image.cropper("getCroppedCanvas", {width: cropWidth, height: cropHeight});
                    let cropPreview = originalData.toDataURL();

                    http.post('/admin/save-image', {
                        crop_path: cropPath,
                        image_path: imagePath,
                        image: cropPreview
                    }).catch(function(data) {
                        swal('Picture saved', null, data.responseText);

                        $('#cropModal #jsCloseCrop').click();
                    });
                });
            });
        });
    </script>
@endsection