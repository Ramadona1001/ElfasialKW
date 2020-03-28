@extends('backend.layouts.master')

@section('title',__('tr.Create New Items'))

@section('packagesactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('backend/imageUpload/image-uploader.min.css') }}">
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Create New Items') - ({{ $packages->name }})
                    </h3>
                </div>
            </div>
            
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('create_items_packages_post', $packages->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        

                        <div class="col-lg-12">
                            <h5>@lang('tr.Items')</h5><hr>
                            <form action="{{ route('store_catalogs') }}" method="post" enctype="multipart/form-data">
                                @csrf
            
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="en_name">@lang('tr.English Name')</label>
                                                    <input type="text" name="en_name" id="name" class="form-control" placeholder="@lang('tr.Enter English Name')" required>
                                                </div>
                                            </div>
                    
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="ar_name">@lang('tr.Arabic Name')</label>
                                                    <input type="text" name="ar_name" id="ar_name" class="form-control" placeholder="@lang('tr.Enter Arabic Name')" required>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="en_desc">@lang('tr.English Descriptions')</label>
                                                    <textarea name="en_desc" id="en_desc" cols="30" rows="10" class="form-control" placeholder="@lang('tr.Enter English Descriptions')" required></textarea>
                                                </div>
                                            </div>
                    
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="ar_desc">@lang('tr.Arabic Descriptions')</label>
                                                    <textarea name="ar_desc" id="ar_desc" cols="30" rows="10" class="form-control" placeholder="@lang('tr.Enter Arabic Descriptions')" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="package_imgs">@lang('tr.Image')</label>
                                                    <input type="file" name="package_imgs" id="package_imgs" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
            
                                       
                    
                                       
                                    </div>
                                    
                                </div>
            
                                <hr>
                                <div class="form-group">
                                    <button type="submit" id="submitBtn" class="btn btn-success">
                                        <i class="fa fa-save"></i>&nbsp;@lang('tr.Save')
                                    </button>
                                </div>

                            </form>
                        </div>

                        
                    </div>

                   
                </div>
            </div>
        </div>
    </div>
</div>

    
</form>
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.example').DataTable({responsive:true});
    } );
</script>
@endsection