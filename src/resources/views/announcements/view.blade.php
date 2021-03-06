@extends('redminportal::layouts.master')

@section('navbar-breadcrumb')
    <li class="active"><span class="navbar-text">{{ Lang::get('redminportal::menus.announcements') }}</span></li>
@stop

@section('content')

    @include('redminportal::partials.errors')
    
    @include('redminportal::partials.html-view-nav-controls', ['models' => $models, 'model_view' => 'announcements'])

    @if (count($models) >0)
        <table class='table table-striped table-bordered table-condensed'>
            <thead>
                <tr>
                    <th>{!! Redminportal::html()->sorter('admin/announcements', 'title', $sortBy, $orderBy) !!}</th>
                    <th>{!! Redminportal::html()->sorter('admin/announcements', 'created_at', $sortBy, $orderBy) !!}</th>
                    <th>{!! Redminportal::html()->sorter('admin/announcements', 'updated_at', $sortBy, $orderBy) !!}</th>
                    <th>{!! Redminportal::html()->sorter('admin/announcements', 'private', $sortBy, $orderBy) !!}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($models as $announcement)
                <tr>
                    <td>{{ $announcement->title }}</td>
                    <td>{{ date('d/m/y h:i A', strtotime($announcement->created_at)) }}</td>
                    <td>{{ date('d/m/y h:i A', strtotime($announcement->updated_at)) }}</td>
                    <td>
                        @if ($announcement->private)
                            <span class="label label-success"><span class='glyphicon glyphicon-ok'></span></span>
                        @else
                            <span class="label label-danger"><span class='glyphicon glyphicon-remove'></span></span>
                        @endif
                    </td>
                    <td class="table-actions text-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
								<span class="glyphicon glyphicon-option-horizontal"></span>
							</button>
						  	<ul class="dropdown-menu pull-right" role="menu">
						        <li>
						            <a href="{{ URL::to('admin/announcements/edit/' . $announcement->id) }}">
						                <i class="glyphicon glyphicon-edit"></i>{{ Lang::get('redminportal::buttons.edit') }}</a>
						        </li>
						        <li>
						            <a href="{{ URL::to('admin/announcements/delete/' . $announcement->id) }}" class="btn-confirm">
						                <i class="glyphicon glyphicon-remove"></i>{{ Lang::get('redminportal::buttons.delete') }}</a>
						        </li>
						  	</ul>
						</div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">
        {!! $models->render() !!}
        </div>
    @else
        @if ($models->lastPage())
        <div class="alert alert-info">{{ Lang::get('redminportal::messages.no_record_page_empty') }}</div>
        <a href="{{ $models->url($models->lastPage()) }}" class="btn btn-default"><span class="glyphicon glyphicon-menu-left"></span> {{ Lang::get('redminportal::buttons.previous_page') }}</a>
        @else
        <div class="alert alert-info">{{ Lang::get('redminportal::messages.no_announcement_found') }}</div>
        @endif
    @endif
@stop
