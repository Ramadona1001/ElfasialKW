@extends('backend.layouts.master')

@section('title',__('tr.Show Package'))

@section('packagesactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Show Package') | {{ $category->name }}
                    </h3>
                </div>
            </div>
            
            @foreach ($packages as $package)
            
            <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample{{$package->id}}" style="padding:10px 20px;">
                <div class="card">
                    <div class="card-header" id="heading{{$package->id}}">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse{{$package->id}}" aria-expanded="false" aria-controls="collapse{{$package->id}}">
                            <i class="flaticon2-delivery-package"></i> {{$package->name}}
                            &nbsp;&nbsp;&nbsp;<a href="{{ route('create_items_packages',$package->id) }}" class="pinkbutton">@lang('tr.Add New Item')</a>
                            @php($packagesParams = [$package->id,$package->category_id])
                            &nbsp;&nbsp;&nbsp;<a href="{{ route('edit_packages',implode(',',$packagesParams)) }}" class="bluebutton">@lang('tr.Edit')</a>
                            &nbsp;&nbsp;&nbsp;<a href="{{ route('destroy_packages',implode(',',$packagesParams)) }}" onclick="return confirm('@lang('tr.Are you Sure?')')" class="redbutton">@lang('tr.Delete')</a>
                            &nbsp;&nbsp;&nbsp;@lang('tr.No Members'): ({{ $package->no_members }})
                            
                        </div>
                    </div>
                    <div id="collapse{{$package->id}}" class="collapse" aria-labelledby="heading{{$package->id}}" data-parent="#accordionExample{{$package->id}}" style="">
                        <div class="card-body">
                            <table class="display example" style="width:100%;" class="table table-bordered dt-responsive">
                                <thead>
                                    <tr>
                                        <th class="tdesign">#</th>
                                        <th class="tdesign">@lang('tr.Item')</th>
                                        <th class="tdesign">@lang('tr.Image')</th>
                                        <th class="tdesign">@lang('tr.Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($langName = \Lang::getLocale().'_name')
                                @foreach ($packagesItems as $index => $item)
                                    @if ($item->package_id == $package->id)
                                        <tr>
                                            <td class="tdesign">{{ $index + 1 }}</td>
                                            <td class="tdesign">{{ $item->$langName }}</td>
                                            <td class="tdesign">
                                                <img src="{{ asset('packages/items/'.$item->package_imgs) }}" style="width:100px;height:100px;" alt="" srcset="">
                                            </td>
                                            
                                            <td class="tdesign">
                                                

                                                @can('delete_packages_items')
                                                    <a href="{{ route('delete_items_packages',$item->id) }}" class="bluebutton">@lang('tr.Delete')</a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="tdesign">#</th>
                                        <th class="tdesign">@lang('tr.Item')</th>
                                        <th class="tdesign">@lang('tr.Image')</th>
                                        <th class="tdesign">@lang('tr.Action')</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                    
            </div>
                @endforeach
                


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
        $('.example').DataTable({responsive:true});
    } );
</script>
@endsection