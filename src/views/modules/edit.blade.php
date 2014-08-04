@extends('redminportal::layouts.master')

@section('content')
    @if($errors->has())
    <div class='alert alert-danger'>
        We encountered the following errors:
        <ul>
            @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{ Form::open(array('files' => TRUE, 'action' => 'Redooor\Redminportal\ModuleController@postStore', 'role' => 'form')) }}
        {{ Form::hidden('id', $module->id)}}

    	<div class='row'>
            <div class="col-md-3 col-md-push-9">
                <div class='form-actions text-right'>
                    {{ HTML::link('admin/modules', 'Cancel', array('class' => 'btn btn-default'))}}
                    {{ Form::submit('Save Changes', array('class' => 'btn btn-primary')) }}
                </div>
                <hr>
                <div class='well well-small'>
                    <div class="form-group">
                        <label for="active" class="checkbox inline">
                            {{ Form::checkbox('featured', $module->featured, $module->featured, array('id' => 'featured-checker')) }} Featured
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="active" class="checkbox inline">
                            {{ Form::checkbox('active', $module->active, $module->active, array('id' => 'active-checker')) }} Active
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('category_id', 'Category') }}
                    {{ Form::select('category_id', $categories, $module->category_id, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('sku', 'SKU') }}
                    {{ Form::text('sku', $module->sku, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('tags', 'Tags (separated by comma)') }}
                    {{ Form::text('tags', $tagString, array('class' => 'form-control')) }}
                </div>
                <div>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                      <div>
                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>{{ Form::file('image') }}</span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-md-pull-3">
                <ul class="nav nav-tabs" id="lang-selector">
                   @foreach(\Config::get('redminportal::translation') as $translation)
                   <li><a href="#lang-{{ $translation['lang'] }}">{{ $translation['name'] }}</a></li>
                   @endforeach
               </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="lang-en">
                        <div class="form-group">
                            {{ Form::label('name', 'Title') }}
                            {{ Form::text('name', $module->name, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('short_description', 'Summary') }}
                            {{ Form::text('short_description', $module->short_description, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('long_description', 'Description') }}
                            {{ Form::textarea('long_description', $module->long_description, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    @foreach(\Config::get('redminportal::translation') as $translation)
                        @if($translation['lang'] != 'en')
                        <div class="tab-pane" id="lang-{{ $translation['lang'] }}">
                            <div class="form-group">
                                {{ Form::label($translation['lang'] . '_name', 'Title') }}
                                {{ Form::text($translation['lang'] . '_name', $module_cn->name, array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label($translation['lang'] . '_short_description', 'Summary') }}
                                {{ Form::text($translation['lang'] . '_short_description', $module_cn->short_description, array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label($translation['lang'] . '_long_description', 'Description') }}
                                {{ Form::textarea($translation['lang'] . '_long_description', $module_cn->long_description, array('class' => 'form-control')) }}
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <h4>Uploaded Photos</h4>
                <div class='row'>
                    @foreach( $module->images as $image )
                    <div class='col-md-3'>
                        {{ HTML::image($imageUrl . $image->path, $module->name, array('class' => 'img-thumbnail', 'alt' => $image->path)) }}
                    </div>
                    @endforeach
                </div>
                @if (isset($pricelists))
                <h3>Price List</h3>
                <table class="table table-striped table-bordered">
                    @foreach ($pricelists as $pricelist)
                        <tr>
                            <td>{{ $pricelist['name'] }}</td>
                            <td>{{ Form::text('price_' . $pricelist['id'], $pricelist['price'], array('class' => 'form-control')) }}</td>
                        </tr>
                    @endforeach
                </table>
                @endif
                <h3>Medias</h3>
                <div id="media-wrapper"></div>
            </div>
        </div>
    {{ Form::close() }}
@stop

@section('footer')
    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script src="{{ URL::to('packages/redooor/redminportal/assets/js/bootstrap-fileupload.js') }}"></script>
    <script>
        !function ($) {
            $(function(){
                $('#lang-selector li').first().addClass('active');
                $('#lang-selector a').click(function (e) {
                    e.preventDefault();
                    $(this).tab('show');
                });
                tinymce.init({
                    selector:'textarea',
                    menubar:false,
                    plugins: "link",
                    toolbar: "undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link"
                });
                // Load medias base on selected category
                function loadMedia() {
                    $selected_val = $('#category_id').val();
                    $('#media-wrapper').empty().load('../editmedias/' + $selected_val + '/' + {{ $module->id }});
                }
                $('#category_id').change(function() {
                    loadMedia();
                });
                // On load, load medias
                loadMedia();
            })
        }(window.jQuery);
    </script>
@stop
