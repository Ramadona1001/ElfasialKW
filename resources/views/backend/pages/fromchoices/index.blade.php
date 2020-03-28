@extends('backend.layouts.master')

@section('title',__('tr.Customer Choices'))

@section('fromchoicesactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    <style>
    .nav-pills .nav-item .nav-link:active, .nav-pills .nav-item .nav-link.active, .nav-pills .nav-item .nav-link.active:hover{
        background-color: #f05f78;
    }
    </style>
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Customer Choices')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    @can('create_fromchoices')
                    <a href="{{ route('create_fromchoices') }}" class="btn btn-primary">@lang('tr.Create New Customer Choices')</a>
                    @endcan
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">

                    @foreach ($fromChoiceCategory as $index => $fromCategory)

                    <div class="kt-portlet" style="border: 1px solid #f05f78;">
                        <div class="kt-portlet__head buffut_tap">
                            <div class="col-xs-12 kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    {{ $fromCategory->categoryName($fromCategory->categories_id)->name }} 
                                    <small>( @lang('tr.Customer Choices') )
                                        @can('create_fromchoices')
                                        <a href="{{ route('create_items_fromchoices',$fromCategory->id) }}" class="bluebutton">@lang('tr.Create New Items')</a>
                                        @endcan
                                        @can('delete_fromchoices')
                                        <a onclick="return confirm('Are You Sure ?')" class="redbutton" href="{{ route('delete_fromchoices',$fromCategory->categories_id) }}">@lang('tr.Delete')</a>
                                        @endcan
                                    </small>
                                </h3>
                            </div>
                            <div class="col-xs-12 kt-portlet__head-toolbar">
                                <ul class="nav nav-pills nav-pills" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_{{ $fromCategory->id }}" role="tab" aria-selected="true">
                                            @lang('tr.Info')
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_{{ $fromCategory->id.'_'.$fromCategory->id }}" role="tab" aria-selected="false">
                                            @lang('tr.Items')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="kt_tabs_{{ $fromCategory->id }}" role="tabpanel">
                                    <img src="{{ asset('fromchoices/'.$fromCategory->fromchoice_image) }}" class="img-responsive buffut_images" style="width:300px;display:block;margin-left:auto;margin-right:auto;">                                    
                                    {{-- @can('show_fromchoices')
                                    <a href="{{ route('show_fromchoices',$buffetCategory->id) }}" class="pinkbutton">@lang('tr.View')</a>&nbsp;
                                    @endcan

                                    @can('edit_fromchoices')
                                    <a href="{{ route('edit_fromchoices',$buffetCategory->id) }}" class="bluebutton">@lang('tr.Edit')</a>&nbsp;
                                    @endcan

                                    @can('delete_fromchoices')
                                    <a onclick="return confirm('Are You Sure ?')" class="redbutton" href="{{ route('delete_fromchoices',$buffetCategory->categories_id) }}">@lang('tr.Delete')</a>
                                    @endcan --}}
                                </div>
                                <div class="tab-pane" id="kt_tabs_{{ $fromCategory->id.'_'.$fromCategory->id }}" role="tabpanel">

                                    @foreach ($items as $item)

                                    @if($item->from_choices_id == $fromCategory->id)

                                    <div class="kt-portlet kt-portlet--mobile" style="border: 1px dashed;">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
                                                    {{ $item->name }} 
                                                    <small>
                                                    @can('edit_fromchoices')
                                                    <a href="{{ route('edit_fromchoices',$item->id) }}" class="bluebutton">@lang('tr.Edit')</a>&nbsp;
                                                    @endcan
                                                    @can('delete_fromchoices')
                                                    <a onclick="return confirm('Are You Sure ?')" class="redbutton" href="{{ route('delete_item_fromchoices',$item->id) }}">@lang('tr.Delete')</a>
                                                    @endcan
                                                    </small>
												</h3>
											</div>
										</div>
										<div class="kt-portlet__body">
                                            @php($fromChoiceItemImages = \DB::select('select * from fromchoices_gallery where fromchoice_id = '.$item->id))
                                            <div class="row">
                                                @foreach ($fromChoiceItemImages as $img)
                                                <div class="col-lg-3">
                                                    <img src="{{ asset('fromchoices/'.$img->image_path) }}" style="width:100px;height:100px;" class="img-responsive img-thumbnail" alt="" srcset="">
                                                </div>
                                                @endforeach
                                            </div>
                                            
                                            <br>
                                            <p style="font-weight:bold;font-size:18px;">{{ $item->desc }}</p>
                                            <p style="font-weight:bold;font-size:18px;">@lang('tr.Price'): {{ $item->price }}</p>
										</div>
                                    </div>
                                    
                                    @endif
                                        
                                    @endforeach


                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                   
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({responsive:true});
    } );
</script>
@endsection