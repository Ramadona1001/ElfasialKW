@extends('backend.layouts.master')

@section('title',__('tr.Show Category'))

@section('categoriesactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Show Category')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    <hr>
                    <img src="{{ asset('uploads/categories/'.$category->cat_image) }}" class="img-responsive img-thumbnail" style="width:200px;display:block;margin-left:auto;margin-right:auto;"><hr>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <p>@lang('tr.Name')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $category->name }}</p>
                        </div>

                        <div class="col-lg-12">
                            <p>@lang('tr.Descriptions')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $category->desc }}</p>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5>@lang('tr.All Catalogs')</h5>
                            <table id="example" class="display" style="width:100%;" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="border:1px solid #eee;padding:10px;">#</th>
                                        <th style="border:1px solid #eee;padding:10px;">@lang('tr.Name')</th>
                                        <th style="border:1px solid #eee;padding:10px;">@lang('tr.Descriptions')</th>
                                        <th style="border:1px solid #eee;padding:10px;">@lang('tr.Image')</th>
                                        <th style="border:1px solid #eee;padding:10px;">@lang('tr.Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($catalogs as $index => $catalog)
                                    <tr>
                                        <td style="border:1px solid #eee;padding:10px;">{{ $index+1 }}</td>
                                        <td style="border:1px solid #eee;padding:10px;">{{ $catalog->name }}</td>
                                        <td style="border:1px solid #eee;padding:10px;">{{ $catalog->desc }}</td>
                                        <td style="border:1px solid #eee;padding:10px;"><img src="{{ asset('catalogs/'.$catalog->catalog_img) }}" class="img-responsive" style="width:100px;"></td>
                                        <td style="border:1px solid #eee;padding:10px;">
                                            
                                            @can('show_catalogs')
                                            <a href="{{ route('show_catalogs',$catalog->id) }}" style="background: orange; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;">@lang('tr.View')</a>&nbsp;
                                            @endcan
        
                                            @can('edit_catalogs')
                                            <a href="{{ route('edit_catalogs',$catalog->id) }}" style="background: purple; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;">@lang('tr.Edit')</a>&nbsp;
                                            @endcan
        
                                            @can('delete_catalogs')
                                            <a onclick="return confirm('Are You Sure ?')" style="background: red; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;" href="{{ route('delete_catalogs',$catalog->id) }}">@lang('tr.Delete')</a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="border:1px solid #eee;padding:10px;">#</th>
                                        <th style="border:1px solid #eee;padding:10px;">@lang('tr.Name')</th>
                                        <th style="border:1px solid #eee;padding:10px;">@lang('tr.Descriptions')</th>
                                        <th style="border:1px solid #eee;padding:10px;">@lang('tr.Image')</th>
                                        <th style="border:1px solid #eee;padding:10px;">@lang('tr.Action')</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                    </div>

                    <hr>
                    <br>
                    <h6 style="text-align:center;">
                        @can('edit_category')
                        <a href="{{ route('edit_category',$category->id) }}" style="background: purple; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;">@lang('tr.Edit')</a>&nbsp;
                        @endcan

                        @can('delete_category')
                        <a onclick="return confirm('Are You Sure ?')" style="background: red; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;" href="{{ route('delete_category',$category->id) }}">@lang('tr.Delete')</a>
                        @endcan
                    </h6>

                    <br>
                    
                </div>
            </div>
        </div>
    </div>
</div>


    
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

@endsection